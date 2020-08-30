<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function indexAction()
    {
        return $this->render(
            'main/index.html.twig'
        );
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function homeAction()
    {
        $team = $this->getUser()->getTeam();

        return $this->render(
            'main/home.html.twig',
            [
                'team' => $team
            ]
        );
    }

    /**
     * @Route("/app", name="app_react")
     */
    public function appReactAction()
    {
        return $this->render(
            'main/react.html.twig'
        );
    }

    /**
     * @Route("/app/{route}", name="app_react_routes", requirements={"token"=".+"})
     */
    public function reactAction()
    {
        return $this->render(
            'main/react.html.twig'
        );
    }
}