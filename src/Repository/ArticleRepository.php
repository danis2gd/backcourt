<?php

namespace App\Repository;

use App\Entity\Article;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[]
     */
    public function getCarouselArticles(): array
    {
        $qb = $this->createQueryBuilder('article');
        $eb = $qb->expr();

        return $qb
            ->andWhere(
                $eb->eq('article.carousel', true),
                $eb->andX(
                    $eb->gte('article.publishDate', Carbon::now()),
                    $eb->eq('article.carousel', true)
                )
            )
            ->orderBy('article.carouselDisplayOrder')
            ->getQuery()
            ->getResult()
        ;
    }
}
