<?php
declare(strict_types=1);

namespace App\DTO;


use App\Entity\Arena;
use App\Entity\Team;
use Carbon\CarbonInterface;

class GameDTO
{
    /**
     * @var Team
     */
    private $home;

    /**
     * @var Team
     */
    private $away;

    /**
     * @var Arena|null
     */
    private $arena;

    /**
     * @var bool
     */
    private $homeAdvantage;

    /**
     * @var int
     */
    private $fans;

    /**
     * @var CarbonInterface
     */
    private $tipOff;

    /**
     * @return Team
     */
    public function getHome(): Team
    {
        return $this->home;
    }

    /**
     * @return Team
     */
    public function getAway(): Team
    {
        return $this->away;
    }

    /**
     * @return Arena|null
     */
    public function getArena(): ?Arena
    {
        return $this->arena;
    }

    /**
     * @return bool
     */
    public function getHomeAdvantage(): bool
    {
        return $this->homeAdvantage;
    }

    /**
     * @return int
     */
    public function getFans(): int
    {
        return $this->fans;
    }

    /**
     * @return CarbonInterface
     */
    public function getTipOff(): CarbonInterface
    {
        return $this->tipOff;
    }
}