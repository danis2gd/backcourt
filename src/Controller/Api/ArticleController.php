<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Classes\AnnotationGroups;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerAwareTrait;

/**
 * Class ArticleController
 * @package App\Controller\Api
 *
 * @Route(name="api_", path="/api")
 */
class ArticleController extends AbstractController
{
    use SerializerAwareTrait;

    /**
     * @Route(name="carousel_articles", path="/carousel_articles")
     *
     * @return JsonResponse
     */
    public function carouselArticles(): Response
    {
        $carouselArticles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return new Response(
            $this->serializer->serialize(
                ['data' => $carouselArticles], // todo: create DTO to handle this
                'json',
                ['groups' => AnnotationGroups::ARTICLE_DATA]
            )
        );
    }
}