<?php
namespace App\MatchMaker\Lobby;

use App\MatchMaker\Players\QueuingPlayer;
use App\MatchMaker\Players\Player;

require_once("Players\QueuingPlayer.php");
require_once("Players\Player.php");

    class Lobby
    {
        /** @var array<QueuingPlayer> */
        public array $queuingPlayers = [];

    
        public function findOponents(QueuingPlayer $player): array
        {
            $minLevel = round($player->getRatio() / 100);
            $maxLevel = $minLevel + $player->getRange();
    
            return array_filter($this->queuingPlayers, static function (QueuingPlayer $potentialOponent) use ($minLevel, $maxLevel, $player) {
                $playerLevel = round($potentialOponent->getRatio() / 100);
    
                return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
            });
        }
        public function addPlayer(Player $player): void
        {
            $this->queuingPlayers[] = new QueuingPlayer($player);
        }
    
        public function addPlayers(Player ...$players): void
        {
            foreach ($players as $player) {
                $this->addPlayer($player);
            }
        }
    }