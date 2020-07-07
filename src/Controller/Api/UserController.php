<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    private static $data = [
        'data' => [
            'id' => 1,
            'name' => 'Daniel Chadwick',
            'roles' => [
                'USER_ROLE',
                'COMMISSIONER_ROLE',
            ],
        ],
    ];

    /**
     * @Route("/user", name="user")
     *
     * @return Response
     */
    public function user(): Response
    {
        return new Response(
            $this->serializer->serialize(self::$data, 'json')
        );
    }
}