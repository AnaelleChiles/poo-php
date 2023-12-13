<?php

namespace App\MatchMaker\Players;

require_once("Players\AbstractPlayer.php");
require_once("Players\Player.php");

class BlitzPlayer extends Player
{
    public function __construct(public string $name = 'anonymous', public float $ratio = 1200.0)
    {
        parent::__construct($name, $ratio);
    }

    public function updateRatioAgainst(AbstractPlayer $player, int $result): void
    {
        $this->ratio += 128 * ($result - $this->probabilityAgainst($player));
    }
}
