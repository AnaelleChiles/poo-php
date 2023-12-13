<?php

/*
 * This file is part of the OpenClassRoom PHP Object Course.
 *
 * (c) Grégoire Hébert <contact@gheb.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

spl_autoload_register(function($fq){
    $path = str_replace(['App\MatchMaker','\\'], ['POO-PHP','/'], $fq).'.php';
});

use App\MatchMaker\Lobby\Lobby;
use App\MatchMaker\Players\BlitzPlayer;

require_once("Players\BlitzPlayer.php");
require_once("Lobby\Lobby.php");

$greg = new BlitzPlayer('greg');
$jade = new BlitzPlayer('jade');

$lobby = new Lobby();
$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOponents($lobby->queuingPlayers[0]));

exit(0);
