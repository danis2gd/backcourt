<?php

namespace App\Repository;

use App\Entity\DepthChart;
use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method DepthChart|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepthChart|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepthChart[]    findAll()
 * @method DepthChart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepthChartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepthChart::class);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('depthChart')
            ->innerJoin('depthChart.team', 'team')
        ;
    }

    /**
     * @param Team $team
     *
     * @return DepthChart
     */
    public function getOneByTeam(Team $team): ?DepthChart
    {
        return $this->getQueryBuilder()
            ->andWhere('team = :team')
            ->setParameter('team', $team)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
