<?php
include_once("global.php");
session_start();

//set the round count
$_SESSION['total_round_completed']++;
$html = "";

if($_SESSION['total_round_completed'] > $totalRoundCount) {
    //Logic to check if round completed & player won or lost based on condition
    if(isset($_SESSION['dead_farmer_count']) || $_SESSION['dead_cows_count'] || $_SESSION['dead_bunnies_count']) {
        if($_SESSION['dead_farmer_count'] >= 1 || $_SESSION['dead_cows_count'] >= 1 || $_SESSION['dead_bunnies_count'] >= 1){
            $html = "You Won!~1";
        }
    }
    else{
        $html = "All round are finished! Start Again!~1";
    }
}
else {
    //Generated random key from combined entity
    $generateRandomKeyFromEntity = array_rand($_SESSION['entities'], 1);

    //Set farmer is feed or not in session
    //if farmer is feed then set the value again to 0 if not increment the count
    if(in_array($generateRandomKeyFromEntity, array_keys($_SESSION['farmer']))) {
        $_SESSION['feed_farmer_count'] = 0;
    }
    else {
        $_SESSION['feed_farmer_count']++;
    }

    //Set cows is feed or not in session
    //if cows is feed then set the value again to 0 if not increment the count  
    foreach($_SESSION['cows'] as $key => $value) {
        if($generateRandomKeyFromEntity == $key) {
            $_SESSION['feed_cow_'.$key.'_count'] = 0;
        }
        else {
            $_SESSION['feed_cow_'.$key.'_count']++;
        }
    }

    //Set bunnies is feed or not in session
    //if bunnies is feed then set the value again to 0 if not increment the count 
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

//Function to validate which entity is died
function validateIfFeedOrDead($randomKeyGeneratedFromEntity) {
    $output = "";

    global $farmerFeedAfterTurn;

    global $cowFeedAfterTurn;

    global $bunnyFeedAfterTurn;

    $output = $_SESSION['total_round_completed']."_".$randomKeyGeneratedFromEntity;

    if($_SESSION['feed_farmer_count'] > $farmerFeedAfterTurn) {
        unset($_SESSION['entities'][1]);
        unset($_SESSION['farmer'][1]); 
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

    
    if($_SESSION['dead_farmer_count'] == 1) {
        $output = "Farmer is dead~4";
    }
    if($_SESSION['dead_cows_count'] == 2) {
        $output = "All Cows are dead~4";
    }
    if($_SESSION['dead_bunnies_count'] == 4) {
        $output = "All Bunnies are dead~4";
    }
    return $output;
}