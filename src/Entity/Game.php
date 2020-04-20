<?php
declare(strict_types=1);

namespace App\Entity;

use App\DTO\GameDTO;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="homeGames")
     * @ORM\JoinColumn(name="intHomeTeamId", referencedColumnName="intTeamId", nullable=true)
     */
    private $home;

    /**
     * @var DepthChart
     *
     * @ORM\OneToOne(targetEntity="App\Entity\DepthChart")
     * @ORM\JoinColumn(name="intHomeDepthChartId", referencedColumnName="intDepthChartId", nullable=true)
     */
    private $homeDepthChart;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="awayGames")
     * @ORM\JoinColumn(name="intAwayTeamId", referencedColumnName="intTeamId", nullable=true)
     */
    private $away;

    /**
     * @var DepthChart
     *
     * @ORM\OneToOne(targetEntity="App\Entity\DepthChart")
     * @ORM\JoinColumn(name="intAwayDepthChartId", referencedColumnName="intDepthChartId", nullable=true)
     */
    private $awayDepthChart;

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
     * @var boolean
     *
     * @ORM\Column(name="bolFinal", type="boolean")
     */
    private $final = false;

    /**
     * Game constructor.
     * @param GameDTO $gameDTO
     */
    private function __construct(GameDTO $gameDTO)
    {
        $this->home = $gameDTO->getHome();
        $this->away = $gameDTO->getAway();
        $this->arena = $gameDTO->getArena();
        $this->homeAdvantage = $gameDTO->getHomeAdvantage();

        $this->fans = $gameDTO->getFans();
        $this->tipOff = $gameDTO->getTipOff();
        $this->final = false;

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
     * @param GameDTO $gameDTO
     *
     * @return Game
     */
    public static function create(GameDTO $gameDTO): self {
        return new self($gameDTO);
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
    public function getHomeTeam(): Team
    {
        return $this->home;
    }

    /**
     * @return Team
     */
    public function getAwayTeam(): Team
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

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->final;
    }
}