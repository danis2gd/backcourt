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
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="depthChart")
     * @ORM\JoinColumn(name="intDepthChartId", referencedColumnName="intDepthChartId")
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
}