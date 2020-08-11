<?php
declare(strict_types=1);

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\Player;
use App\Entity\Post;
use App\Entity\Team;
use App\Entity\User;
use App\Enumeration\NavigationEnumerator;
use App\Form\TeamType;
use App\Form\UserSettingFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayersController
 * @package App\Controller
 *
 * @Route(name="app_blog_", path="/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route(name="index", path="/")
     *
     * @return Response
     */
    public function index(): Response
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

        return $this->render(
            'main/blog/index.html.twig',
            [
                'posts' => $posts,
            ]
        );
    }

    /**
     * @Route(name="post", path="/{postId}")
     *
     * @param int $postId
     *
     * @return Response
     */
    public function post(int $postId): Response
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findOneBy(['id' => $postId]);

        return $this->render(
            'main/blog/post.html.twig',
            [
                'post' => $post,
            ]
        );
    }
}