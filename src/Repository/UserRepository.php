<?php

namespace App\Repository;

use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $userName
     *
     * @return User|null
     */
    public function getByName(string $userName): ?User
    {
        return $this->createQueryBuilder('user')
            ->andWhere('user.username = :userName')
            ->setParameter('userName', $userName)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $uuid
     *
     * @return User|null
     */
    public function getByUuid(string $uuid): ?User
    {
        return $this->createQueryBuilder('user')
            ->andWhere('user.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getBasicDataByUuid(string $uuid): ?User {
        return $this->createQueryBuilder('user')
            ->addSelect(['primaryUserTeam', 'team', 'teams', 'arena', 'players'])
            ->leftJoin('user.primaryUserTeam', 'primaryUserTeam')
            ->leftJoin('user.userTeams', 'teams')
            ->leftJoin('primaryUserTeam.team', 'team')
            ->leftJoin('team.arena', 'arena')
            ->leftJoin('team.roster', 'players')
            ->andWhere('user = :userUuid')
            ->setParameter('userUuid', $uuid)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }
}
