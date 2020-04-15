<?php
declare(strict_types=1);

namespace App\Entity;

use App\DTO\MatchDTO;
use App\Exception\InvalidEntityException;
use Carbon\CarbonInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="tblGame"
 * )
 *
 * @ORM\Entity()
 */
class Game
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intGameId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Team
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(name="intHomeTeamId", referencedColumnName="intTeamId", nullable=true)
     */
    private $home;

    /**
     * @var Team
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(name="intAwayTeamId", referencedColumnName="intTeamId", nullable=true)
     */
    private $away;

    /**
     * @var Arena|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Arena")
     * @ORM\JoinColumn(name="intArenaId", referencedColumnName="intArenaId", nullable=true)
     */
    private $arena;

    /**
     * @var bool
     *
     * @ORM\Column(name="bolHomeAdvantage", type="boolean")
     */
    private $homeAdvantage;

    /**
     * @var int
     *
     * @ORM\Column(name="intFans", type="integer", length=20, options={"unsigned"})
     */
    private $fans;

    /**
     * @var CarbonInterface
     *
     * @ORM\Column(name="dtmTipOff", type="carbondatetimetz")
     */
    private $tipOff;

    /**
     * Game constructor.
     * @param MatchDTO $matchDTO
     */
    private function __construct(MatchDTO $matchDTO)
    {
        $this->home = $matchDTO->getHome();
        $this->away = $matchDTO->getAway();
        $this->arena = $matchDTO->getArena();
        $this->homeAdvantage = $matchDTO->getHomeAdvantage();

        $this->fans = $matchDTO->getFans();
        $this->tipOff = $matchDTO->getTipOff();

        $this->guardEntity();
    }

    /**
     * @throws InvalidEntityException
     */
    private function guardEntity(): void {
        if ($this->fans > $this->arena->getCapacity()) {
            throw new InvalidEntityException('Not enough seats.');
        }
    }

    /**
     * @param MatchDTO $matchDTO
     *
     * @return Game
     */
    public static function create(MatchDTO $matchDTO): self {
        return new self($matchDTO);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

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