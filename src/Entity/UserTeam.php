<?php

declare(strict_types=1);

namespace App\Entity;

use App\DBAL\Types\RoleType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="tblUserTeamMap"
 * )
 *
 * @ORM\Entity()
 */
class UserTeam
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intUserTeamId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userTeams")
     * @ORM\JoinColumn(name="strUuid", referencedColumnName="strUuid")
     */
    private $user;

    /**
     * @var Team
     *
     * @ORM\OneToOne(targetEntity="Team", mappedBy="userTeam")
     * @ORM\JoinColumn(name="intTeamId", referencedColumnName="intTeamId")
     */
    private $team;

    private function __construct(
        User $user,
        Team $team
    )
    {
        $this->user = $user;
        $this->team = $team;

        if (!$this->user->getPrimaryUserTeam() instanceof UserTeam) {
            $this->user->updatePrimaryTeam($this);
        }
    }

    /**
     * @param User $user
     * @param Team $team
     *
     * @return UserTeam
     */
    public static function create(
        User $user,
        Team $team
    ) {
        return new self($user, $team);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }
}