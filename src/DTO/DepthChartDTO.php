<?php
declare(strict_types=1);

namespace App\DTO;

use App\Entity\Player;
use App\Entity\Position;

class DepthChartDTO
{
    /**
     * @var Player|null
     */
    public $pointGuard;

    /**
     * @var Player|null
     */
    public $shootingGuard;

    /**
     * @var Player|null
     */
    public $smallForward;

    /**
     * @var Player|null
     */
    public $powerForward;

    /**
     * @var Player|null
     */
    public $center;

    /**
     * @var Player|null
     */
    public $sixthMan;

    /**
     * @var Player|null
     */
    public $seventhMan;

    /**
     * @var Player|null
     */
    public $eighthMan;

    /**
     * @var Player|null
     */
    public $ninthMan;

    /**
     * @var Player|null
     */
    public $tenthMan;

    /**
     * @var Player|null
     */
    public $eleventhMan;

    /**
     * @var Player|null
     */
    public $twelfthMan;

    /**
     * @param array $depthChart
     */
    public function populate(array $depthChart) {
        $this->setPointGuard($depthChart[Position::POINT_GUARD]);
        $this->setShootingGuard($depthChart[Position::SHOOTING_GUARD]);
        $this->setSmallForward($depthChart[Position::SMALL_FORWARD]);
        $this->setPowerForward($depthChart[Position::POWER_FORWARD]);
        $this->setCenter($depthChart[Position::CENTER]);
        $this->setSixthMan($depthChart[Position::SIXTH_MAN]);
        $this->setSeventhMan($depthChart[Position::SEVENTH_MAN]);
        $this->setEighthMan($depthChart[Position::EIGHTH_MAN]);
        $this->setNinthMan($depthChart[Position::NINTH_MAN]);
        $this->setTenthMan($depthChart[Position::TENTH_MAN]);
        $this->setEleventhMan($depthChart[Position::ELEVENTH_MAN]);
        $this->setTwelfthMan($depthChart[Position::TWELFTH_MAN]);
    }

    /**
     * @return Player|null
     */
    public function getPointGuard(): ?Player
    {
        return $this->pointGuard;
    }

    /**
     * @param Player $pointGuard
     */
    public function setPointGuard(?Player $pointGuard): void
    {
        $this->pointGuard = $pointGuard;
    }

    /**
     * @return Player|null
     */
    public function getShootingGuard(): ?Player
    {
        return $this->shootingGuard;
    }

    /**
     * @param Player $shootingGuard
     */
    public function setShootingGuard(?Player $shootingGuard): void
    {
        $this->shootingGuard = $shootingGuard;
    }

    /**
     * @return Player|null
     */
    public function getSmallForward(): ?Player
    {
        return $this->smallForward;
    }

    /**
     * @param Player $smallForward
     */
    public function setSmallForward(?Player $smallForward): void
    {
        $this->smallForward = $smallForward;
    }

    /**
     * @return Player|null
     */
    public function getPowerForward(): ?Player
    {
        return $this->powerForward;
    }

    /**
     * @param Player $powerForward
     */
    public function setPowerForward(?Player $powerForward): void
    {
        $this->powerForward = $powerForward;
    }

    /**
     * @return Player|null
     */
    public function getCenter(): ?Player
    {
        return $this->center;
    }

    /**
     * @param Player $center
     */
    public function setCenter(?Player $center): void
    {
        $this->center = $center;
    }

    /**
     * @return Player|null
     */
    public function getSixthMan(): ?Player
    {
        return $this->sixthMan;
    }

    /**
     * @param Player|null $sixthMan
     */
    public function setSixthMan(?Player $sixthMan): void
    {
        $this->sixthMan = $sixthMan;
    }

    /**
     * @return Player|null
     */
    public function getSeventhMan(): ?Player
    {
        return $this->seventhMan;
    }

    /**
     * @param Player|null $seventhMan
     */
    public function setSeventhMan(?Player $seventhMan): void
    {
        $this->seventhMan = $seventhMan;
    }

    /**
     * @return Player|null
     */
    public function getEighthMan(): ?Player
    {
        return $this->eighthMan;
    }

    /**
     * @param Player|null $eighthMan
     */
    public function setEighthMan(?Player $eighthMan): void
    {
        $this->eighthMan = $eighthMan;
    }

    /**
     * @return Player|null
     */
    public function getNinthMan(): ?Player
    {
        return $this->ninthMan;
    }

    /**
     * @param Player|null $ninthMan
     */
    public function setNinthMan(?Player $ninthMan): void
    {
        $this->ninthMan = $ninthMan;
    }

    /**
     * @return Player|null
     */
    public function getTenthMan(): ?Player
    {
        return $this->tenthMan;
    }

    /**
     * @param Player|null $tenthMan
     */
    public function setTenthMan(?Player $tenthMan): void
    {
        $this->tenthMan = $tenthMan;
    }

    /**
     * @return Player|null
     */
    public function getEleventhMan(): ?Player
    {
        return $this->eleventhMan;
    }

    /**
     * @param Player|null $eleventhMan
     */
    public function setEleventhMan(?Player $eleventhMan): void
    {
        $this->eleventhMan = $eleventhMan;
    }

    /**
     * @return Player|null
     */
    public function getTwelfthMan(): ?Player
    {
        return $this->twelfthMan;
    }

    /**
     * @param Player|null $twelfthMan
     */
    public function setTwelfthMan(?Player $twelfthMan): void
    {
        $this->twelfthMan = $twelfthMan;
    }
}