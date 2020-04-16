<?php
declare(strict_types=1);

namespace App\Entity;

use App\DTO\PlayerDTO;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strFirstName", type="string", length=40)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="strLastName", type="string", length=40)
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="intAge", type="integer", length=20, options={"unsigned"})
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="strPosition", type="string", length=20, options={"unsigned"})
     */
    private $position;

    /**
     * @var College|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\College")
     * @ORM\JoinColumn(name="intCollegeId", referencedColumnName="intCollegeId", nullable=true)
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
     */
    private $gameShape;

    /**
     * @var int
     *
     * @ORM\Column(name="intOverall", type="integer", options={"unsigned"})
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
}
