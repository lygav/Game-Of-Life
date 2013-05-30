<?php

include 'GameDriver.php';

$game = new GameDriver(
    new Gof(
        array(
            '0,0',
            '0,1',
            '1,0',
            '9,9',
            '10,9',
            '11,9',
            '11,10',
            '10,11',
        )
    ),
    15, 20);
$game->run(30);