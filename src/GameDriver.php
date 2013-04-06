<?php
/**
 * Author: Vlad Lyga
 *
 */

include '../autoloader.php';

class GameDriver {

    private $width  = 0;
    private $height = 0;

    /**
     * @param object $game the gof object
     * @param int $width of the visible world
     * @param int $height of the visible world
     */
    function __construct($game, $width, $height)
    {
        $this->game = $game;

        $this->width  = $width;
        $this->height = $height;
    }

    function run($iterations)
    {
        $this->render($this->game->live_cells);
        while ($iterations) {
            $this->render($this->game->evolve());
            $iterations -= 1;
        }
    }

    private function render($coordinates)
    {
        for ($w = $this->width; $w >= 0; $w --) {
            $tokens = '';
            for ($h = $this->height; $h >= 0 ; $h --) {
                if (false !== array_search(($h.','.$w), $coordinates))
                    $tokens .= '#';
                else
                    $tokens .= '-';
            }
            echo $tokens.PHP_EOL;
        }
        echo PHP_EOL;
    }
}