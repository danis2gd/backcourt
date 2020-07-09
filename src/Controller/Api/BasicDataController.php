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
 * Class BasicDataController
 * @package App\Controller\Api
 *
 * @Route("/api", name="api_")
 */
class BasicDataController extends AbstractController
{
    use SerializerAwareTrait;

    /**
     * @Route("/basic_data", name="basic_data")
     *
     * @return Response
     */
    public function basicData(): Response
    {
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            return new JsonResponse(
                [
                    'error' => 'Not authenticated.',
                    'data' => null
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $basicData = $this->getDoctrine()
            ->getRepository(User::class)
            ->getBasicDataByUuid($user->getUuid());

        if (!$basicData instanceof UserInterface) {
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
                ['data' => $basicData],
                'json',
                ['groups' => [AnnotationGroups::USER_DATA, AnnotationGroups::TEAM_DATA, AnnotationGroups::PLAYER_DATA]]
            )
        );
    }
}