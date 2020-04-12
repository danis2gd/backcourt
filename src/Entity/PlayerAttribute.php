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
     * @var float
     *
     * @ORM\Column(name="decJumpShot", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $jumpShot;

    /**
     * @var float
     *
     * @ORM\Column(name="decJumpShotRange", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $jumpShotRange;

    /**
     * @var float
     *
     * @ORM\Column(name="decLayup", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $layup;

    /**
     * @var float
     *
     * @ORM\Column(name="decDunk", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $dunk;

    /**
     * @var float
     *
     * @ORM\Column(name="decHandling", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $handling;

    /**
     * @var float
     *
     * @ORM\Column(name="decPassing", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $passing;

    /**
     * @var float
     *
     * @ORM\Column(name="decFreeThrow", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $freeThrow;

    /**
     * @var float
     *
     * @ORM\Column(name="decInsideDefence", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $insideDefence;

    /**
     * @var float
     *
     * @ORM\Column(name="decBlocking", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $blocking;

    /**
     * @var float
     *
     * @ORM\Column(name="decOutsideDefence", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $outsideDefence;

    /**
     * @var float
     *
     * @ORM\Column(name="decStamina", type="decimal", precision=5, scale=0)
     * @Assert\Range(min = 0, max = 100, minMessage = "Min % is 0", maxMessage = "Max % is 100")
     */
    private $stamina;

    private function __construct(Player $player, PlayerAttributeDTO $playerAttributeDTO)
    {
        $this->player = $player;

        $this->jumpShot = $playerAttributeDTO->getJumpShot();
        $this->jumpShotRange = $playerAttributeDTO->getJumpShotRange();
        $this->layup = $playerAttributeDTO->getLayup();
        $this->dunk = $playerAttributeDTO->getDunk();
        $this->handling = $playerAttributeDTO->getHandling();
        $this->passing = $playerAttributeDTO->getPassing();
        $this->freeThrow = $playerAttributeDTO->getFreeThrow();
        $this->insideDefence = $playerAttributeDTO->getInsideDefence();
        $this->blocking = $playerAttributeDTO->getBlocking();
        $this->outsideDefence = $playerAttributeDTO->getOutsideDefence();
        $this->stamina = $playerAttributeDTO->getStamina();
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
     * @return float
     */
    public function getJumpShot(): float
    {
        return $this->jumpShot;
    }

    /**
     * @return float
     */
    public function getJumpShotRange(): float
    {
        return $this->jumpShotRange;
    }

    /**
     * @return float
     */
    public function getLayup(): float
    {
        return $this->layup;
    }

    /**
     * @return float
     */
    public function getDunk(): float
    {
        return $this->dunk;
    }

    /**
     * @return float
     */
    public function getHandling(): float
    {
        return $this->handling;
    }

    /**
     * @return float
     */
    public function getPassing(): float
    {
        return $this->passing;
    }

    /**
     * @return float
     */
    public function getFreeThrow(): float
    {
        return $this->freeThrow;
    }

    /**
     * @return float
     */
    public function getInsideDefence(): float
    {
        return $this->insideDefence;
    }

    /**
     * @return float
     */
    public function getBlocking(): float
    {
        return $this->blocking;
    }

    /**
     * @return float
     */
    public function getOutsideDefence(): float
    {
        return $this->outsideDefence;
    }

    /**
     * @return float
     */
    public function getStamina(): float
    {
        return $this->stamina;
    }
}