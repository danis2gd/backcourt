<?php
declare(strict_types=1);

namespace App\Entity;

use App\DTO\TeamDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Classes\AnnotationGroups;

/**
 * @ORM\Table(
 *     name="tblTeam"
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intTeamId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({AnnotationGroups::TEAM_DATA})
     */
    private $id;

    /**
     * @var UserTeam
     *
     * @ORM\OneToOne(targetEntity="UserTeam", inversedBy="team", cascade={"persist"})
     * @ORM\JoinColumn(name="intUserTeamId", referencedColumnName="intUserTeamId")
     */
    private $userTeam;

    /**
     * @var string
     *
     * @ORM\Column(name="strName", type="string", length=40, unique=true)
     *
     * @Groups({AnnotationGroups::TEAM_DATA})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="strAbbreviation", type="string", length=3, unique=true)
     *
     * @Groups({AnnotationGroups::TEAM_DATA})
     */
    private $abbreviation;

    /**
     * @var Arena
     *
     * @ORM\OneToOne(targetEntity="Arena", cascade={"persist"})
     * @ORM\JoinColumn(name="intArenaId", referencedColumnName="intArenaId")
     *
     * @Groups({AnnotationGroups::TEAM_DATA})
     */
    private $arena;

    /**
     * @var Game[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Game", mappedBy="home", cascade={"persist"})
     */
    private $homeGames;

    /**
     * @var Game[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Game", mappedBy="away", cascade={"persist"})
     */
    private $awayGames;

    private $brandLogo;

    /**
     * @var Player[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team")
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $roster;

    /**
     * @var DepthChart|null
     *
     * @ORM\OneToOne(targetEntity="DepthChart", mappedBy="team")
     * @ORM\JoinColumn(name="intDepthChartId", referencedColumnName="intDepthChartId", nullable=true)
     */
    private $depthChart;

    /**
     * Team constructor.
     * @param User $user
     * @param TeamDTO $teamDTO
     */
    private function __construct(User $user, TeamDTO $teamDTO)
    {
        $this->name = $teamDTO->getName();
        $this->abbreviation = $teamDTO->getAbbreviation();

        $this->userTeam = UserTeam::create($user, $this);

        $this->arena = Arena::create(
            $this->getName() . '\'s Arena', 20000
        );

        $this->roster = new ArrayCollection();
    }

    /**
     * @param User $user
     * @param TeamDTO $teamDTO
     *
     * @return Team
     */
    public static function create(User $user, TeamDTO $teamDTO)
    {
        return new self($user, $teamDTO);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->getUserTeam()->getUser();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @return mixed
     */
    public function getBrandLogo()
    {
        return $this->brandLogo;
    }

    /**
     * @return Arena|null
     */
    public function getArena(): ?Arena
    {
        return $this->arena;
    }

    /**
     * @return Player[]
     */
    public function getRoster()
    {
        return $this->roster;
    }

    /**
     * @return Player[]
     */
    public function getAvailableRoster(): array
    {
        $availablePlayers = [];

        foreach ($this->getRoster() as $player) {
            if (!$this->getDepthChart()->getPlayers()->contains($player)
                && !$player->isInjured()
            ) {
                $availablePlayers[] = $player;
            }
        }

        return $availablePlayers;
    }

    /**
     * @return Game[]|ArrayCollection
     */
    public function getGames()
    {
        return array_merge(
            $this->homeGames->toArray(),
            $this->awayGames->toArray()
        );
    }

    /**
     * @return DepthChart|null
     */
    public function getDepthChart(): ?DepthChart
    {
        return $this->depthChart;
    }

    /**
     * @return UserTeam
     */
    public function getUserTeam(): UserTeam
    {
        return $this->userTeam;
    }
}