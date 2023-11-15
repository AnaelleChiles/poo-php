<?php



class Player
{
    private $level;

    public function getLevel(): int
    {
        return $this->level;
    }
    public function setLevel(int $niveau): int
    {
        $this->level = $niveau;
        return $this->level;
    }

}

class Encounter
{
    const RESULT_WINNER = 1;
    const RESULT_LOSER = -1;
    const RESULT_DRAW = 0;
    const RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];

    public static function probabilityAgainst(int $PlayerLevelOne, int $againstLevelPlayerTwo)
    {
        return 1 / (1 + (10 ** (($againstLevelPlayerTwo - $PlayerLevelOne) / 400)));
    }

    public static function setNewLevel(Player $PlayerOne, Player $againstPlayerTwo, int $playerOneResult)
    {
        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', self::RESULT_POSSIBILITIES)));
        }

        $PlayerOne->setLevel($PlayerOne->getLevel() + (int) (32 * ($playerOneResult - self::probabilityAgainst($PlayerOne->getLevel(), $againstPlayerTwo->getLevel()))));
    }
}

$greg = new Player();
$greg->setLevel(400);
$jade = new Player();
$jade->setLevel(800);

$rencontre = new Encounter();

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    $rencontre->probabilityAgainst($greg->getLevel(), $jade->getLevel()) * 100
) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
$rencontre->setNewLevel($greg, $jade, $rencontre::RESULT_WINNER);
$rencontre->setNewLevel($jade, $greg, $rencontre::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->getLevel(),
    $jade->getLevel()
);

exit(0);