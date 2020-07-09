<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Classes\AnnotationGroups;

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
     *
     * @Groups({AnnotationGroups::TEAM_DATA})
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
     *
     * @Groups({AnnotationGroups::TEAM_DATA, AnnotationGroups::PLAYER_DATA})
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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