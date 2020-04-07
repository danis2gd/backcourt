<?php

declare(strict_types=1);

namespace App\Entity;

use App\DBAL\Types\RoleType;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as EnumAssert;

/**
 * @ORM\Table(
 *     name="tblUserRoleMap"
 * )
 *
 * @ORM\Entity()
 */
class UserRole
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intUserRoleId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userRoles")
     * @ORM\JoinColumn(name="strUuid", referencedColumnName="strUuid")
     */
    private $user;

    /**
     * @var RoleType
     *
     * @ORM\Column(name="strRole", type="RoleType", nullable=false)
     * @EnumAssert\Enum(entity="App\DBAL\Types\RoleType")
     */
    private $role;

    private function __construct(
        User $user,
        string $role
    )
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * @param User $user
     * @param string $role
     *
     * @return UserRole
     */
    public static function create(
        User $user,
        string $role
    ) {
        return new self($user, $role);
    }

    /**
     * @return RoleType
     */
    public function getRole(): string
    {
        return $this->role;
    }
}