<?php
include_once("global.php");
session_start();
$_SESSION['total_round_completed']++;
$html = "";

if($_SESSION['total_round_completed'] > $totalRoundCount) {
    $html = '1';
}
else {
    $generateRandomKeyFromEntity = array_rand($_SESSION['entities'], 1);

    if(in_array($generateRandomKeyFromEntity, array_keys($_SESSION['farmer']))) {
        $_SESSION['feed_farmer_count'] = 0;
    }
    else {
        $_SESSION['feed_farmer_count']++;
    }

    foreach($_SESSION['cows'] as $key => $value) {
        if($generateRandomKeyFromEntity == $key) {
            $_SESSION['feed_cow_'.$key.'_count'] = 0;
        }
        else {
            $_SESSION['feed_cow_'.$key.'_count']++;
        }
    }

    foreach($_SESSION['bunnies'] as $k => $v) {
        if($generateRandomKeyFromEntity == $k) {
            $_SESSION['feed_bunny_'.$k.'_count'] = 0;
        }
        else {
            $_SESSION['feed_bunny_'.$k.'_count']++;
        }
    }

    $html = validateIfFeedOrDead($generateRandomKeyFromEntity);
}

echo $html;

function validateIfFeedOrDead($randomKeyGeneratedFromEntity) {
    $output = "";

    global $farmerFeedAfterTurn;
    $diedFarmer = 0;

    global $cowFeedAfterTurn;

    global $bunnyFeedAfterTurn;

    $output = $_SESSION['total_round_completed']."_".$randomKeyGeneratedFromEntity;

    if($_SESSION['feed_farmer_count'] > $farmerFeedAfterTurn) {
        $diedFarmer = 1;
        unset($_SESSION['entities'][$diedFarmer]);
        unset($_SESSION['farmer'][$diedFarmer]); 
        $_SESSION['dead_farmer_count'] = 1;        
    }

    foreach($_SESSION['cows'] as $c_key => $c_value) {
        if($_SESSION['feed_cow_'.$c_key.'_count'] > $cowFeedAfterTurn) {
            unset($_SESSION['entities'][$c_key]);
            unset($_SESSION['cows'][$c_key]);            
            $_SESSION['dead_cows_count'] += 1;
        }
    }

    foreach($_SESSION['bunnies'] as $b_key => $b_value) {
        if($_SESSION['feed_bunny_'.$b_key.'_count'] > $bunnyFeedAfterTurn) {
            unset($_SESSION['entities'][$b_key]);
            unset($_SESSION['bunnies'][$b_key]);            
            $_SESSION['dead_bunnies_count'] += 1;
        }
    }

    
    if($diedFarmer > 0 && $_SESSION['dead_farmer_count'] == 1) {
        $output = "Farmer is dead~$diedFarmer";
    }
    if($_SESSION['dead_cows_count'] == 2) {
        $output = "All Cows are dead~4";
    }
    if($_SESSION['dead_bunnies_count'] == 4) {
        $output = "All Bunnies are dead~4";
    }
    return $output;
}