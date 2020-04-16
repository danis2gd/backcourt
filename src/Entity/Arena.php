<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="tblArena"
 * )
 *
 * @ORM\Entity()
 */
class Arena
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intArenaId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strName", type="string", length=40, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="intCapacity", type="integer", length=20, options={"unsigned"})
     */
    private $capacity;

    /**
     * Arena constructor.
     * @param string $name
     * @param int $capacity
     */
    private function __construct(string $name, int $capacity)
    {
        $this->name = $name;
        $this->capacity = $capacity;
    }

    /**
     * @param string $name
     * @param int $capacity
     *
     * @return Arena
     */
    public static function create(string $name, int $capacity = 20000) {
        return new self($name, $capacity);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }
}