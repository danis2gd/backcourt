<?php

namespace App\Repository;

use App\Entity\Post;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return Post[]
     */
    public function getCarouselPosts(): array
    {
        $qb = $this->createQueryBuilder('post');
        $eb = $qb->expr();

        return $qb
            ->andWhere(
                $eb->eq('post.carousel', true),
                $eb->andX(
                    $eb->gte('post.publishDate', Carbon::now()),
                    $eb->eq('post.carousel', true)
                )
            )
            ->orderBy('post.carouselDisplayOrder')
            ->getQuery()
            ->getResult()
        ;
    }
}
