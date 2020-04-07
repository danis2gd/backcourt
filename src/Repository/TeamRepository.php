<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    /**
     *
     */
    public function getAllQueryBuilder() {
        return $this->createQueryBuilder('team')
            ->addSelect('arena')
            ->innerJoin('team.arena', 'arena')
        ;
    }

    /**
     * @param int $id
     *
     * @return Team|null
     *
     * @throws NonUniqueResultException
     */
    public function findOneById(int $id): ?Team
    {
        return $this->getAllQueryBuilder()
            ->andWhere('team.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $name
     *
     * @return Team|null
     *
     * @throws NonUniqueResultException
     */
    public function findOneByName(string $name): ?Team
    {
        return $this->getAllQueryBuilder()
            ->andWhere('team.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
