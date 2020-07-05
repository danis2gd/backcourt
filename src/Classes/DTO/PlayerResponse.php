<?php
declare(strict_types=1);

namespace App\Classes\DTO;

use App\Entity\Player;
use JMS\Serializer\Annotation as Serializer;

class PlayerResponse
{
    /**
     * @var Player|null
     *
     * @Serializer\Expose()
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
     * PlayerResponse constructor.
     *
     * @param Player $player
     */
    private function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @param Player $player
     *
     * @return PlayerResponse
     */
    public static function create(Player $player): self {
        return new self($player);
    }
}