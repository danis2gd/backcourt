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

    public function getById(int $postId)
    {
        $qb = $this->createQueryBuilder('post');
        $expr = $qb->expr();

        return $qb
            ->addSelect('user')
            ->innerJoin('post.author', 'user')
            ->andWhere(
                $expr->eq('post.id', ':postId')
            )
            ->setParameter('postId', $postId)
            ->getQuery()
            ->getOneOrNullResult();
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
                $eb->orX(
                    $eb->lte('post.publishDate', ':time'),
                    $eb->isNull('post.publishDate')
                )
            )
            ->setParameters([
                'time' => Carbon::now()
            ])
            ->orderBy('post.carouselDisplayOrder')
            ->getQuery()
            ->getResult();
    }
}
