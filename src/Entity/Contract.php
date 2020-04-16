<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="tblContract"
 * )
 *
 * @ORM\Entity()
 */
class Contract
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intContractId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Player", inversedBy="contract")
     * @ORM\JoinColumn(name="intPlayerId", referencedColumnName="intPlayerId")
     */
    private $player;

    /**
     * @var Team
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(name="intTeamId", referencedColumnName="intTeamId")
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\Column(name="decSalary", type="decimal", precision=10, scale=2)
     */
    private $salary;

    /**
     * @var int
     *
     * @ORM\Column(name="intRemaining", type="integer")
     */
    private $remaining;
}