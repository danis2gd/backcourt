<?php

declare(strict_types=1);

namespace App\Entity;

use App\DBAL\Types\RoleType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(
 *     name="tblUser"
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var string|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="strUuid", type="guid", length=40, unique=true)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="strUsername", type="string", length=40, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="strEmail", type="string", length=80, unique=true)
     */
    private $email;

    /**
     * @var ArrayCollection|UserRole[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\UserRole", mappedBy="user", cascade={"persist"})
     */
    private $userRoles;

    /**
     * @var string
     *
     * @ORM\Column(name="strPassword", type="string", length=120)
     */
    private $password;

    /**
     * @var UserTeam|null
     *
     * @ORM\OneToOne(targetEntity="UserTeam", cascade={"persist"})
     * @ORM\JoinColumn(name="intUserTeamId", referencedColumnName="intUserTeamId", nullable=true)
     */
    private $primaryUserTeam;

    /**
     * @var ArrayCollection|UserTeam[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\UserTeam", mappedBy="user", cascade={"persist"})
     */
    private $userTeams;

    /**
     * User constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     * @param Team|null $team
     */
    private function __construct(string $username, string $email, string $password, ?Team $team = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;

        $this->userRoles = new ArrayCollection();
        $this->userRoles->add(UserRole::create($this, RoleType::ROLE_USER));

        $this->userTeams = new ArrayCollection();

        if ($team instanceof Team) {
            $this->setPrimaryTeam(UserTeam::create($this, $team));
        }
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     *
     * @return User
     */
    public static function create($username, $email, $password): User
    {
        return new self(
            $username,
            $email,
            $password
        );
    }

    /**
     * @return User
     */
    public static function emptyUser(): User
    {
        return new self(
            '',
            '',
            ''
        );
    }

    /**
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        if ($this->username) {
            return $this->username;
        }

        return $this->email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return array_unique(
            array_merge(['ROLE_USER'], $this->getRoleHandles())
        );
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string[]
     */
    private function getRoleHandles(): array
    {
        $roleHandles = [];

        foreach ($this->userRoles as $userRole) {
            $roleHandles[] = $userRole->getRole();
        }

        return $roleHandles;
    }

    /**
     * @return UserTeam|null
     */
    public function getPrimaryUserTeam(): ?UserTeam
    {
        return $this->primaryUserTeam;
    }

    /**
     * @param UserTeam $userTeam
     */
    public function updatePrimaryTeam(UserTeam $userTeam)
    {
        $this->primaryUserTeam = $userTeam;

        if (!$this->userTeams->contains($userTeam)) {
            $this->userTeams->add($userTeam);
        }
    }

    /**
     * @return Team|null
     */
    public function getTeam(): ?Team
    {
        if (!$this->primaryUserTeam instanceof UserTeam) {
            return null;
        }

        return $this->primaryUserTeam->getTeam();
    }
}
