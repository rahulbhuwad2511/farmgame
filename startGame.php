<?php
include_once("global.php");
session_start();
$_SESSION['total_round_completed'] = 0;

$_SESSION['entities'] = $entities;
$_SESSION['farmer'] = $farmer;
$_SESSION['cows'] = $cows;
$_SESSION['bunnies'] = $bunnies;

$_SESSION['feed_farmer_count'] = 0;

foreach($_SESSION['cows'] as $key => $value) {
    $_SESSION['feed_cow_'.$key.'_count'] = 0;
}

foreach($_SESSION['bunnies'] as $k => $v) {
    $_SESSION['feed_bunny_'.$k.'_count'] = 0;
}

$_SESSION['dead_farmer_count'] = 0;
$_SESSION['dead_cows_count'] = 0;
$_SESSION['dead_bunnies_count'] = 0;

$table = "<table border='1'>";
for($i = 0; $i <= $totalRoundCount; $i++) {
    $table .= "<tr>";
    for($j = 0; $j <= count($entities); $j++) {
        if($i > 0 && $j == 0) {
            $table .= "<td>$i</td>";
        }
        elseif($i > 0 && $j > 0) {
            $table .= "<td id='cell".$i."_".$j."'></td>";
        }
        elseif($i == 0){
            $table .= "<th id='cell".$i."_".$j."'>".((isset($entities[$j])) ? $entities[$j] : 'Round')."</th>";
        }
    }
    $table .= "</tr>";
}
$table .= "</table>";
echo $table;