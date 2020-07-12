<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function indexAction()
    {
        $team = $this->getUser()->getTeam();

        return $this->render(
            'main/index.html.twig',
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