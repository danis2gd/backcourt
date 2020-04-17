<?php
declare(strict_types=1);

namespace App\Classes;

use App\Entity\Player;

class SalaryEstimator {
    public static function estimate(Player $player): float
    {
        return round(($player->getOverall() * 100000) / 0.6, 2);
    }
}