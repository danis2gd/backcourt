<?php

namespace App\Controller;

use App\DTO\UserDTO;
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
 * Class UserController
 * @package App\Controller
 *
 * @Route(name="app_error_", path="/")
 */
class ErrorController extends AbstractController
{
    /**
     * @Route(name="404", path="/404")
     *
     * @param string $errorMessage
     *
     * @return Response
     */
    public function indexAction(string $errorMessage): Response
    {
        return $this->render(
            'main/error/404.html.twig',
            [
                'errorMessage' => $errorMessage
            ]
        );
    }
}