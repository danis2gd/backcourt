<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\LookupInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(
 *     name="ublRole"
 * )
 *
 * @ORM\Entity(readOnly=true)
 *
 * @UniqueEntity(fields={"handle"})
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Role implements LookupInterface
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intRoleId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strHandle", unique=true)
     */
    private $handle;

    private function __construct(string $handle)
    {
        $this->handle = $handle;
    }

    public function create(string $handle) {
        return new self($handle);
    }

    /**
     * @return $this
     */
    public static function user(): self {
        return new self(self::ROLE_USER);
    }

    /**
     * @return $this
     */
    public static function admin(): self {
        return new self(self::ROLE_ADMIN);
    }

    /**
     * @param int $id
     */
    public function setId(int $id) {
        $this->id = $id;
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
    public function getHandle(): string
    {
        return $this->handle;
    }

    public function __toString(): string
    {
        dump('hi');
        return  "hello";
    }


}