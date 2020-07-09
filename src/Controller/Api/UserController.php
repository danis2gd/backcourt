<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Classes\AnnotationGroups;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;

/**
 * Class UserController
 * @package App\Controller\Api
 *
 * @Route("/api", name="api_")
 */
class UserController extends AbstractController
{
    use SerializerAwareTrait;

    /**
     * @Route("/user/{uuid}", name="user")
     *
     * @param string $uuid
     *
     * @return Response
     */
    public function user(string $uuid): Response
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->getByUuid($uuid);

        if (!$user instanceof User) {
            return new JsonResponse(
                [
                    'error' => 'Could not find User.',
                    'data' => null
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new Response(
            $this->serializer->serialize(
                $user,
                'json',
                ['groups' => AnnotationGroups::USER_DATA]
            )
        );
    }
}