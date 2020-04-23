<?php

declare(strict_types=1);

namespace App\Traits;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Trait EntityManagerTrait.
 */
trait EntityManagerTrait
{
    /**
     * @var EntityManagerInterface
     */
    protected $doctrine;

    /**
     * @var string[]
     */
    private $usedManagers = [];

    /**
     * @param EntityManagerInterface $doctrine
     */
    public function setDoctrine(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param bool $checkIsSet
     *
     * @return EntityManagerInterface
     */
    public function getDoctrine($checkIsSet = true)
    {
        if ($checkIsSet) {
            $this->isDoctrineSet();
        }

        return $this->doctrine;
    }

    /**
     * @return EntityManagerInterface
     */
    protected function getManager()
    {
        return $this->getDoctrine();
    }

    /**
     * Close connection.
     */
    protected function closeConnection()
    {
        $this->getConnection()->close();
    }

    /**
     * Open connection.
     */
    protected function openConnection()
    {
        $this->getConnection()->connect();
    }

    /**
     * @return Connection
     */
    protected function getConnection(): Connection
    {
        return $this->getDoctrine()->getConnection();
    }

    /**
     * @see ObjectManager::flush()
     */
    protected function flush()
    {
        $this->getManager()->flush();
    }

    /**
     * @throws \Exception
     */
    private function isDoctrineSet()
    {
        if (!$this->doctrine instanceof EntityManagerInterface) {
            throw new \Exception('Doctrine has not been set');
        }
    }
}
