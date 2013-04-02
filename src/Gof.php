<?php
/**
 * Author: Vlad Lyga
 *
 */

class Gof {

    function __construct(array $live_cells)
    {
        $this->live_cells = $live_cells;
    }

    function evolve()
    {
        if (count($this->live_cells) <= 1) {
            return array();
        } else {
            return $this->next_generation();
        }
    }

    private function next_generation()
    {
        $next_gen = array();
        $cell_reference_frequencies = $this->calculate_neigbours_frequencies();
        foreach ($cell_reference_frequencies as $cell => $frequency) {
            if ($this->should_cell_live($cell, $frequency)) $next_gen[] = $cell;
        }

        return $this->live_cells = $next_gen;
    }

    private function should_cell_live($cell, $frequency)
    {
        if (false !== array_search($cell, $this->live_cells))
            return $this->should_live_cell_live($frequency);
        else
            return $this->should_dead_cell_live($frequency);
    }

    private function should_live_cell_live($frequency)
    {
        return ($frequency == 2 or $frequency == 3);
    }

    private function should_dead_cell_live($frequency)
    {
        return $frequency == 3;
    }


    private function calculate_neigbours_frequencies()
    {
        $total_frequencies = array();
        foreach ($this->live_cells as $cell) {
            list($x, $y) = explode(',', $cell);
            $total_frequencies = array_merge($total_frequencies, $this->get_neighbours(array('x' => $x, 'y' => $y)));
        }

        return array_count_values($total_frequencies);
    }

    private function get_neighbours(array $cell)
    {
        $neighbours_coordinates_range = range(-1, 1);
        $frequencies = array();
        foreach ($neighbours_coordinates_range as $x) {
            foreach ($neighbours_coordinates_range as $y) {
                if (($x.','.$y) !== '0,0')
                    $frequencies[] = ($cell['x'] + $x).','.($cell['y'] + $y);
            }
        }

        return $frequencies;
    }
}