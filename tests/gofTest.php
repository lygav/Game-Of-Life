<?php

include '../autoloader.php';

class GofTest extends PHPUnit_Framework_TestCase
{

	public function testLiveCellWithNoNeigboursDies ()
	{
		$game = new Gof(array('1,1'));
		$this->assertEmpty($game->evolve());
	}

	public function testLiveCellWithOneLiveNeighbourDies ()
	{
		$game = new Gof(array('0,0', '1,1'));
		$this->assertEmpty($game->evolve());
	}

	public function liveCellsWithTwoLiveNeighboursFixture ()
	{
		return array(
			array(array('10,10', '10,9', '11,9')),
			array(array('10,10', '9,10', '11,10')),
			array(array('10,10', '9,11', '11,11')),
		);
	}

	/**
	 * @dataProvider liveCellsWithTwoLiveNeighboursFixture
	 */
	public function testLiveCellWithTwoLiveNeigboursLives (array $fixture)
	{
		$game     = new Gof($fixture);
		$next_gen = $game->evolve();
		$this->assertContains('10,10', $next_gen);
	}

	public function testLiveCellWithThreeLiveNeigboursLives ()
	{
		$game     = new Gof(array('10,10', '11,11', '9,9', '11,9'));
		$next_gen = $game->evolve();
		$this->assertContains('10,10', $next_gen);
	}

	public function testDeadCellWithThreeLiveNeighboursBecomesAlive ()
	{
		$game     = new Gof(array('0,0', '2,0', '2,2'));
		$next_gen = $game->evolve();
		$this->assertTrue(count($next_gen) == 1);
		$this->assertContains('1,1', $next_gen);
	}

}