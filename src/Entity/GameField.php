<?php

namespace Btinet\Tictactoe\Entity;

class GameField
{

    private int $x;
    private int $y;
    private Player|null $player;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y, Player|null $player)
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
     * @return string
     */
    public function getPosition(): string
    {
        return $this->x . $this->y;
    }

    public function equals(GameField $field): bool
    {

        if ($field->getPosition() == $this->getPosition()) {
            return true;
        }

        return false;
    }

    /**
     * @return Player|null
     */
    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    /**
     * @param Player|null $player
     */
    public function setPlayer(?Player $player): void
    {
        $this->player = $player;
    }

}
