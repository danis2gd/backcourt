<?php
declare(strict_types=1);

namespace App\DTO;

class PlayerAttributeDTO
{
    /**
     * @var float
     */
    private $jumpShot;

    /**
     * @var float
     */
    private $jumpShotRange;

    /**
     * @var float
     */
    private $layup;

    /**
     * @var float
     */
    private $dunk;

    /**
     * @var float
     */
    private $handling;

    /**
     * @var float
     */
    private $passing;

    /**
     * @var float
     */
    private $freeThrow;

    /**
     * @var float
     */
    private $insideDefence;

    /**
     * @var float
     */
    private $blocking;

    /**
     * @var float
     */
    private $outsideDefence;

    /**
     * @var float
     */
    private $stamina;

    /**
     * @var float
     */
    private $speed;

    /**
     * @return float
     */
    public function getJumpShot(): float
    {
        return $this->jumpShot;
    }

    /**
     * @param float $jumpShot
     */
    public function setJumpShot(float $jumpShot): void
    {
        $this->jumpShot = $jumpShot;
    }

    /**
     * @return float
     */
    public function getJumpShotRange(): float
    {
        return $this->jumpShotRange;
    }

    /**
     * @param float $jumpShotRange
     */
    public function setJumpShotRange(float $jumpShotRange): void
    {
        $this->jumpShotRange = $jumpShotRange;
    }

    /**
     * @return float
     */
    public function getLayup(): float
    {
        return $this->layup;
    }

    /**
     * @param float $layup
     */
    public function setLayup(float $layup): void
    {
        $this->layup = $layup;
    }

    /**
     * @return float
     */
    public function getDunk(): float
    {
        return $this->dunk;
    }

    /**
     * @param float $dunk
     */
    public function setDunk(float $dunk): void
    {
        $this->dunk = $dunk;
    }

    /**
     * @return float
     */
    public function getHandling(): float
    {
        return $this->handling;
    }

    /**
     * @param float $handling
     */
    public function setHandling(float $handling): void
    {
        $this->handling = $handling;
    }

    /**
     * @return float
     */
    public function getPassing(): float
    {
        return $this->passing;
    }

    /**
     * @param float $passing
     */
    public function setPassing(float $passing): void
    {
        $this->passing = $passing;
    }

    /**
     * @return float
     */
    public function getFreeThrow(): float
    {
        return $this->freeThrow;
    }

    /**
     * @param float $freeThrow
     */
    public function setFreeThrow(float $freeThrow): void
    {
        $this->freeThrow = $freeThrow;
    }

    /**
     * @return float
     */
    public function getInsideDefence(): float
    {
        return $this->insideDefence;
    }

    /**
     * @param float $insideDefence
     */
    public function setInsideDefence(float $insideDefence): void
    {
        $this->insideDefence = $insideDefence;
    }

    /**
     * @return float
     */
    public function getBlocking(): float
    {
        return $this->blocking;
    }

    /**
     * @param float $blocking
     */
    public function setBlocking(float $blocking): void
    {
        $this->blocking = $blocking;
    }

    /**
     * @return float
     */
    public function getOutsideDefence(): float
    {
        return $this->outsideDefence;
    }

    /**
     * @param float $outsideDefence
     */
    public function setOutsideDefence(float $outsideDefence): void
    {
        $this->outsideDefence = $outsideDefence;
    }

    /**
     * @return float
     */
    public function getStamina(): float
    {
        return $this->stamina;
    }

    /**
     * @param float $stamina
     */
    public function setStamina(float $stamina): void
    {
        $this->stamina = $stamina;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }
}