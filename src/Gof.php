<?php

class Gof
{

	public function __construct (array $live_cells)
	{
		$this->live_cells = $live_cells;
	}

	public function evolve ()
	{
		if (count($this->live_cells) <= 1) {
			return array();
		} else {
			return $this->next_generation();
		}
	}

	private function next_generation ()
	{
		$next_gen = array();
		$cell_ref_frequencies = $this->calcualte_cell_ref_frequencies();
		foreach ($cell_ref_frequencies as $cell => $frequency) {
			if ($this->should_cell_live($cell, $frequency)) {
				$next_gen[] = $cell;
			}
		}
		return $this->live_cells = $next_gen;
	}

	private function should_cell_live ($cell, $frequency)
	{
		if (FALSE !== array_search($cell, $this->live_cells)) {
			return $this->should_stay_alive($frequency);
		} else {
			return $this->should_become_alive($frequency);
		}
	}

	private function should_stay_alive ($frequency)
	{
		return ($frequency == 2 OR $frequency == 3);
	}

	private function should_become_alive ($frequency)
	{
		return $frequency == 3;
	}

	private function calcualte_cell_ref_frequencies ()
	{
		$total_frequencies = array();
		foreach ($this->live_cells as $cell) {
			list($x, $y) = explode(',', $cell);
			$total_frequencies = array_merge($total_frequencies, $this->get_cell_neighbours(array('x' => $x, 'y' => $y)));
		}
		return array_count_values($total_frequencies);
	}

	private function get_cell_neighbours (array $cell)
	{
		$offsets = array(- 1, 0, 1);
		$neighbours = array();
		foreach ($offsets as $offset_x) {
			foreach ($offsets as $offset_y) {
				if (($offset_x . ',' . $offset_y) !== '0,0') {
					$neighbours[] = ($cell['x'] + $offset_x) . ',' . ($cell['y'] + $offset_y);
				}
			}
		}
		return $neighbours;
	}
}