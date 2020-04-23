<?php
declare(strict_types=1);

namespace App\Classes\Saver;

use App\DTO\DepthChartDTO;
use App\Entity\DepthChart;
use App\Entity\Team;
use App\Interfaces\DoctrineAwareInterface;
use App\Traits\EntityManagerTrait;
use Doctrine\ORM\EntityManagerInterface;

class DepthChartSaver implements DoctrineAwareInterface {
    use EntityManagerTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setDoctrine($entityManager);
    }

    public function save(Team $team, DepthChartDTO $depthChartDTO) {

        $depthChart = $this->getManager()
            ->getRepository(DepthChart::class)
            ->getOneByTeam($team);

        if ($depthChart instanceof DepthChart) {
            $depthChart->update($depthChartDTO);
        } else {
            $depthChart = DepthChart::create($team, $depthChartDTO);
            $this->getManager()->persist($depthChart);
        }

        $this->getManager()->flush();
    }
}