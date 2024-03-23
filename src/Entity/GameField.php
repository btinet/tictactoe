<?php

namespace Btinet\Tictactoe\Entity;

class GameField
{

    private int $x;
    private int $y;
    private Player $player;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y, Player $player)
    {
        $this->x = $x;
        $this->y = $y;
        $this->player = $player;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

}
