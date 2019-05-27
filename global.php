<?php
//No of round allowed
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

//Merge All
$entities = array_merge($farmer, $cows, $bunnies);

//Operation to start key from 1 for merged array 
array_unshift($entities, "");
unset($entities[0]);

//After no of count each entity should be feed
$farmerFeedAfterTurn = 15;
$cowFeedAfterTurn = 10;
$bunnyFeedAfterTurn = 8;