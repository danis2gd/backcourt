<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="tblDepthChart"
 * )
 *
 * @ORM\Entity()
 */
class DepthChart
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intDepthChartId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Team
     *
     * @ORM\OneToOne(targetEntity="Team", inversedBy="depthChart")
     * @ORM\JoinColumn(name="intTeamId", referencedColumnName="intTeamId")
     */
    private $team;

    /**
     * @var string|null
     */
    private $offensiveScheme;

    /**
     * @var string|null
     */
    private $defensiveScheme;

    /**
     * @var string|null
     */
    private $effort;

    /**
     * @var string|null
     */
    private $pace;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intPointGuardId", referencedColumnName="intPlayerId")
     */
    private $pointGuard;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intShootingGuardId", referencedColumnName="intPlayerId")
     */
    private $shootingGuard;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intSmallForwardId", referencedColumnName="intPlayerId")
     */
    private $smallForward;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intPowerForwardId", referencedColumnName="intPlayerId")
     */
    private $powerForward;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intCenterId", referencedColumnName="intPlayerId")
     */
    private $center;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intSixthManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $sixthMan;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intSeventhManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $seventhMan;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intEightManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $eighthMan;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intNinthManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $ninthMan;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intTenthManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $tenthMan;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intEleventhManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $eleventhMan;

    /**
     * @var Player|null
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="intTwelfthManId", referencedColumnName="intPlayerId", nullable=true)
     */
    private $twelfthMan;

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
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @return string|null
     */
    public function getOffensiveScheme(): ?string
    {
        return $this->offensiveScheme;
    }

    /**
     * @return string|null
     */
    public function getDefensiveScheme(): ?string
    {
        return $this->defensiveScheme;
    }

    /**
     * @return string|null
     */
    public function getEffort(): ?string
    {
        return $this->effort;
    }

    /**
     * @return string|null
     */
    public function getPace(): ?string
    {
        return $this->pace;
    }

    /**
     * @return Player
     */
    public function getPointGuard(): Player
    {
        return $this->pointGuard;
    }

    /**
     * @return Player
     */
    public function getShootingGuard(): Player
    {
        return $this->shootingGuard;
    }

    /**
     * @return Player
     */
    public function getSmallForward(): Player
    {
        return $this->smallForward;
    }

    /**
     * @return Player
     */
    public function getPowerForward(): Player
    {
        return $this->powerForward;
    }

    /**
     * @return Player
     */
    public function getCenter(): Player
    {
        return $this->center;
    }

    /**
     * @return Player|null
     */
    public function getSixthMan(): ?Player
    {
        return $this->sixthMan;
    }

    /**
     * @return Player|null
     */
    public function getSeventhMan(): ?Player
    {
        return $this->seventhMan;
    }

    /**
     * @return Player|null
     */
    public function getEighthMan(): ?Player
    {
        return $this->eighthMan;
    }

    /**
     * @return Player|null
     */
    public function getNinthMan(): ?Player
    {
        return $this->ninthMan;
    }

    /**
     * @return Player|null
     */
    public function getTenthMan(): ?Player
    {
        return $this->tenthMan;
    }

    /**
     * @return Player|null
     */
    public function getEleventhMan(): ?Player
    {
        return $this->eleventhMan;
    }

    /**
     * @return Player|null
     */
    public function getTwelfthMan(): ?Player
    {
        return $this->twelfthMan;
    }
}