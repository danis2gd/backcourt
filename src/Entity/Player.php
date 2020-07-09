<?php
declare(strict_types=1);

namespace App\Entity;

use App\Classes\SalaryEstimator;
use App\DTO\PlayerDTO;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Classes\AnnotationGroups;

/**
 * @ORM\Table(
 *     name="tblPlayer"
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intPlayerId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strFirstName", type="string", length=40)
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="strLastName", type="string", length=40)
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="intAge", type="integer", length=20, options={"unsigned"})
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="strPosition", type="string", length=20, options={"unsigned"})
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $position;

    /**
     * @var College|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\College")
     * @ORM\JoinColumn(name="intCollegeId", referencedColumnName="intCollegeId", nullable=true)
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $college;

    /**
     * @var int
     *
     * @ORM\Column(name="intHeightCm", type="integer", length=20, options={"unsigned"})
     */
    private $heightCm;

    /**
     * @var int
     *
     * @ORM\Column(name="intSalary", type="integer", length=255, options={"unsigned"})
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $salary; // todo: refactor this into multi-season contracts

    /**
     * @var int
     *
     * @ORM\Column(name="intExperience", type="integer", length=20, options={"unsigned"})
     */
    private $experience;

    /**
     * @var int
     *
     * @ORM\Column(name="intGameShape", type="integer", length=20, options={"unsigned"})
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     */
    private $gameShape;

    /**
     * @var int
     *
     * @ORM\Column(name="intOverall", type="integer", options={"unsigned"})
     *
     * @Groups({AnnotationGroups::PLAYER_DATA})
     *
     * # todo: this is calculated based on the PlayerAttribute and cached
     */
    private $overall;

    /**
     * @var Team|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="roster")
     * @ORM\JoinColumn(name="intTeamId", referencedColumnName="intTeamId", nullable=true)
     */
    private $team;

    /**
     * @var PlayerAttribute|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\PlayerAttribute", mappedBy="player")
     * @ORM\JoinColumn(name="intPlayerAttributeId", referencedColumnName="intPlayerAttributeId")
     */
    private $attributes;

    /**
     * @var Contract|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Contract", mappedBy="player")
     * @ORM\JoinColumn(name="intContractId", referencedColumnName="intContractId", nullable=true)
     */
    private $contract;

    /**
     * @var DepthChart
     */
    private $depthChart;

    /**
     * @var bool
     *
     * @ORM\Column(name="bolInjured", type="boolean")
     */
    private $injured = false;

    /**
     * Player constructor.
     * @param PlayerDTO $playerDTO
     * @param Team|null $team
     */
    private function __construct(PlayerDTO $playerDTO, ?Team $team = null)
    {
        $this->firstName = $playerDTO->getFirstName();
        $this->lastName = $playerDTO->getLastName();

        $this->age = $playerDTO->getAge();
        $this->heightCm = $playerDTO->getHeightCm();
        $this->salary = $playerDTO->getSalary();

        $this->team = $team;
    }

    /**
     * @param PlayerDTO $playerDTO
     * @param Team|null $team
     *
     * @return Player
     */
    public static function create(PlayerDTO $playerDTO, ?Team $team = null): Player
    {
        return new self(
            $playerDTO,
            $team
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getName(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return Team|null
     */
    public function getTeam(): ?Team
    {
        return $this->team;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return PlayerAttribute
     */
    public function getAttributes(): PlayerAttribute
    {
        return $this->attributes;
    }

    /**
     * @return College|null
     */
    public function getCollege(): ?College
    {
        return $this->college;
    }

    /**
     * @return float
     */
    public function getExpectedSalary(): float
    {
        return SalaryEstimator::estimate($this);
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @return int
     */
    public function getGameShape(): int
    {
        return $this->gameShape;
    }

    /**
     * @return int
     */
    public function getOverall(): int
    {
        return $this->overall;
    }

    /**
     * @return bool
     */
    public function isInjured(): bool
    {
        return $this->injured;
    }
}
