<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('player')
            ->innerJoin('player.attributes', 'attributes')
            ->leftJoin('player.team', 'team')
            ->leftJoin('player.college', 'college')
            ->leftJoin('player.contract', 'contract')
        ;
    }

    /**
     * @return Player[]
     */
    public function findAllFreeAgents(): array
    {
        return $this->createQueryBuilder('player')
            ->andWhere('player.team IS NULL')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param string $name
     *
     * @return Player
     */
    public function findByName(string $name): Player
    {
        return $this->getQueryBuilder()
            ->andWhere('CONCAT(player.firstName, \' \', player.lastName) = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
