<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    private static $data = [
        'data' => [
            'team' => [
                'id' => 1,
                'name' => 'Chicago Bulls',
                'abbreviation' => 'CHI',
            ],
            'user' => [
                'uuid' => '820f0e16-7d77-11ea-8d4d-a683e722796e',
                'name' => 'Daniel Chadwick',
                'roles' => [
                    'USER_ROLE',
                    'COMMISSIONER_ROLE',
                ]
            ]
        ],
    ];

    /**
     * @Route("/basic_data", name="basic_data")
     *
     * @return Response
     */
    public function basicData(): Response
    {
        return new Response(
            $this->serializer->serialize(self::$data, 'json')
        );
    }
}