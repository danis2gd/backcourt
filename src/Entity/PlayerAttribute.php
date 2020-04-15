<?php
declare(strict_types=1);

namespace App\Entity;

use App\DTO\PlayerAttributeDTO;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(
 *     name="tblPlayerAttribute"
 * )
 *
 * @ORM\Entity()
 */
class PlayerAttribute
{
    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intPlayerAttributeId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Player", inversedBy="attributes")
     * @ORM\JoinColumn(name="intPlayerId", referencedColumnName="intPlayerId")
     */
    private $player;

    /**
     * SHOOTING
     */

    /**
     * @var string
     *
     * @ORM\Column(name="decJumpShot", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $jumpShot;

    /**
     * @var string
     *
     * @ORM\Column(name="decJumpShotRange", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $jumpShotRange;

    /**
     * @var string
     *
     * @ORM\Column(name="decFreeThrow", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $freeThrow;

    /**
     * INSIDE SCORING
     */

    /**
     * @var string
     *
     * @ORM\Column(name="decLayup", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $layup;

    /**
     * @var string
     *
     * @ORM\Column(name="decDunk", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $dunk;

    /**
     * PLAY MAKING
     */

    /**
     * @var string
     *
     * @ORM\Column(name="decHandling", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $handling;

    /**
     * @var string
     *
     * @ORM\Column(name="decPassing", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $passing;

    /**
     * DEFENSE
     */

    /**
     * @var string
     *
     * @ORM\Column(name="decInsideDefence", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $insideDefence;

    /**
     * @var string
     *
     * @ORM\Column(name="decOutsideDefence", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $outsideDefence;

    /**
     * @var string
     *
     * @ORM\Column(name="decBlocking", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $blocking;

    /**
     * @var string
     *
     * @ORM\Column(name="decSteals", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $steals;

    /**
     * ATHLETICISM
     */

    /**
     * @var string
     *
     * @ORM\Column(name="decStamina", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $stamina;

    /**
     * @var string
     *
     * @ORM\Column(name="decSpeed", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $speed;

    private function __construct(Player $player, PlayerAttributeDTO $playerAttributeDTO)
    {
        $this->player = $player;

        $this->jumpShot = $playerAttributeDTO->getJumpShot();
        $this->jumpShotRange = $playerAttributeDTO->getJumpShotRange();
        $this->freeThrow = $playerAttributeDTO->getFreeThrow();

        $this->layup = $playerAttributeDTO->getLayup();
        $this->dunk = $playerAttributeDTO->getDunk();

        $this->handling = $playerAttributeDTO->getHandling();
        $this->passing = $playerAttributeDTO->getPassing();

        $this->insideDefence = $playerAttributeDTO->getInsideDefence();
        $this->blocking = $playerAttributeDTO->getBlocking();
        $this->outsideDefence = $playerAttributeDTO->getOutsideDefence();

        $this->stamina = $playerAttributeDTO->getStamina();
        $this->speed = $playerAttributeDTO->getSpeed();
    }

    public function create(Player $player, PlayerAttributeDTO $playerAttributeDTO) {
        return new self($player, $playerAttributeDTO);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getJumpShot(): string
    {
        return $this->jumpShot;
    }

    /**
     * @return string
     */
    public function getJumpShotRange(): string
    {
        return $this->jumpShotRange;
    }

    /**
     * @return string
     */
    public function getLayup(): string
    {
        return $this->layup;
    }

    /**
     * @return string
     */
    public function getDunk(): string
    {
        return $this->dunk;
    }

    /**
     * @return string
     */
    public function getHandling(): string
    {
        return $this->handling;
    }

    /**
     * @return string
     */
    public function getPassing(): string
    {
        return $this->passing;
    }

    /**
     * @return string
     */
    public function getFreeThrow(): string
    {
        return $this->freeThrow;
    }

    /**
     * @return string
     */
    public function getInsideDefence(): string
    {
        return $this->insideDefence;
    }

    /**
     * @return string
     */
    public function getBlocking(): string
    {
        return $this->blocking;
    }

    /**
     * @return string
     */
    public function getSteals(): string
    {
        return $this->steals;
    }

    /**
     * @return string
     */
    public function getOutsideDefence(): string
    {
        return $this->outsideDefence;
    }

    /**
     * @return string
     */
    public function getStamina(): string
    {
        return $this->stamina;
    }

    /**
     * @return string
     */
    public function getSpeed(): string
    {
        return $this->speed;
    }
}