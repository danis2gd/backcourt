<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Classes\AnnotationGroups;
use App\Entity\Post;
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
class PostController extends AbstractController
{
    use SerializerAwareTrait;

    /**
     * @Route(name="carousel_posts", path="/carousel_posts")
     *
     * @return JsonResponse
     */
    public function carouselPosts(): Response
    {
        $carouselPosts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

        return new Response(
            $this->serializer->serialize(
                ['data' => $carouselPosts], // todo: create DTO to handle this
                'json',
                ['groups' => AnnotationGroups::POST_DATA]
            )
        );
    }
}