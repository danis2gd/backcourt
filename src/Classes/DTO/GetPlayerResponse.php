<?php
declare(strict_types=1);

namespace App\Classes\DTO;

use App\Entity\Player;

class GetPlayerResponse
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
}