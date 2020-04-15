<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="tblCollege"
 * )
 *
 * @ORM\Entity()
 */
class College
{
    /**
     * @var integer|null
     *
     * @ORM\Id()
     * @ORM\Column(name="intCollegeId", type="integer", length=20, unique=true, options={"unsigned"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strName", type="string", length=20, unique=true)
     */
    private $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}