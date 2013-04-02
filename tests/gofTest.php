<?php
/**
 * Author: Vlad Lyga
 *
 */

include '../autoloader.php';

class GofTest extends PHPUnit_Framework_TestCase
{

    function testLiveCellWithNoNeigboursDies()
    {
        $game = new Gof(array('1,1'));
        $this->assertEmpty($game->evolve());
    }

    function testLiveCellWithOneNeighbourDies()
    {
        $game = new Gof(array('0,0', '1,1'));
        $this->assertEmpty($game->evolve());
    }

    function testLiveCellWithTwoNeigboursLive()
    {
        $game = new Gof(array('10,10', '11,11', '9,9'));
        $next_gen = $game->evolve();
        $this->assertContains('10,10', $next_gen);
    }

    function testLiveCellWithThreeNeigboursLive()
    {
        $game = new Gof(array('10,10', '11,11', '9,9', '11,9'));
        $next_gen = $game->evolve();
        $this->assertContains('10,10', $next_gen);
    }

    function testDeadCellWithThreeNeighboursBecomesAlive()
    {
        $game = new Gof(array('0,0', '2,0', '2,2'));
        $next_gen = $game->evolve();
        $this->assertTrue(count($next_gen) == 1);
        $this->assertContains('1,1', $next_gen);
    }

}