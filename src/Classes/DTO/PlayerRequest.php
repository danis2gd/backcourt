<?php
declare(strict_types=1);

namespace App\Classes\DTO;

use App\Entity\Player;

class PlayerRequest
{
    /**
     * @var Player|null
     */
    private $player;

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