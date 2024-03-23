<?php

namespace Btinet\Tictactoe\Entity;

enum Player
{
    case ONE;
    case TWO;

    public function getIcon(): string
    {
        return match ($this) {
            self::ONE => 'circle',
            self::TWO => 'x-lg'
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ONE => 'darkblue',
            self::TWO => 'darkred'
        };
    }
}