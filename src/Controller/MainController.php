<?php

namespace App\Controller;

use App\Enumeration\NavigationEnumerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function indexAction() {

        $team = $this->getUser()->getTeam();

        return $this->render(
            'main/index.html.twig',
            [
                'team' => $team
            ]
        );
    }
}