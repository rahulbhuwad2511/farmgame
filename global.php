<?php
$totalRoundCount = 50;
$farmer = array(
    1 => 'farmer'
);
$cows = array(
    2 => 'cow1',
    3 => 'cow2'
);
$bunnies = array(
    4 => 'bunny1',
    5 => 'bunny2',
    6 => 'bunny3',
    7 => 'bunny4'
);

$entities = array_merge($farmer, $cows, $bunnies);
array_unshift($entities, "");
unset($entities[0]);

$farmerFeedAfterTurn = 15;
$cowFeedAfterTurn = 10;
$bunnyFeedAfterTurn = 8;