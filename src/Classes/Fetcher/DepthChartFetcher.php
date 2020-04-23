<?php
declare(strict_types=1);

namespace App\Classes\Fetcher;

use App\DTO\DepthChartDTO;
use App\Entity\DepthChart;
use App\Entity\Player;
use App\Interfaces\DoctrineAwareInterface;
use App\Traits\EntityManagerTrait;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;

class DepthChartFetcher implements DoctrineAwareInterface {
    use EntityManagerTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setDoctrine($entityManager);
    }

    public function fetch(array $depthChartData): array {
        $playerEntities = [];

        foreach ($depthChartData as $key => $data) {
            $playerEntities[$key] = $this->getManager()
                ->getRepository(Player::class)
                ->getOneById((int) $data);
        }

        return $playerEntities;
    }
}