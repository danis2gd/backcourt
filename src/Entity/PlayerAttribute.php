<?php
declare(strict_types=1);

namespace App\Entity;

use App\DTO\PlayerAttributeDTO;
use Doctrine\ORM\Mapping as ORM;

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
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intPlayerAttributeId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Player")
     * @ORM\JoinColumn(name="intPlayerId", referencedColumnName="intPlayerId")
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(name="intJumpShot", type="integer", length=1, options={"unsigned"})
     */
    private $jumpShot;

    /**
     * @var int
     *
     * @ORM\Column(name="intLayup", type="integer", length=1, options={"unsigned"})
     */
    private $layup;

    /**
     * @var int
     *
     * @ORM\Column(name="intDunk", type="integer", length=1, options={"unsigned"})
     */
    private $dunk;

    private $handling;

    private $passing;

    private $freeThrow;

    /**
     * @var int
     *
     * @ORM\Column(name="intOutsideJumpShot", type="integer", length=1, options={"unsigned"})
     */
    private $outsideJumpShot;

    /**
     * @var int
     *
     * @ORM\Column(name="intInsideDefence", type="integer", length=1, options={"unsigned"})
     */
    private $insideDefence;

    private $blocking;

    /**
     * @var int
     *
     * @ORM\Column(name="intOutsideDefence", type="integer", length=1, options={"unsigned"})
     */
    private $outsideDefence;

    private $stamina;

    private function __construct(Player $player, PlayerAttributeDTO $playerAttributeDTO)
    {
        $this->player = $player;
    }

    public function create(Player $player, PlayerAttributeDTO $playerAttributeDTO) {
        return new self($player, $playerAttributeDTO);
    }
}