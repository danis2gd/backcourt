<?php

declare(strict_types=1);

namespace App\Interfaces;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Interface DoctrineAwareInterface.
 */
interface DoctrineAwareInterface
{
    /**
     * @param EntityManagerInterface $doctrine
     */
    public function setDoctrine(EntityManagerInterface $doctrine);
}
