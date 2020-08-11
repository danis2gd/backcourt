<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Enumeration\NavigationEnumerator;
use App\Form\UserSettingFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route(name="app_user_", path="/user")
 */
class UserController extends AbstractController {
    /**
     * @Route(name="home", path="/{user}")
     *
     * @param string|null $userName
     *
     * @return Response
     */
    public function indexAction(?string $userName = null): Response
    {
        $settingsForm = null;

        $userDTO = new UserDTO();
        $userDTO->populate($this->getUser());

        if (null === $userName) {
            $user = $this->getUser();
        } else {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->getByName($userName);
        }

        $settingsForm = $this->createForm(UserSettingFormType::class, $userDTO)
            ->createView();

        return $this->render(
            'main/profile/index.html.twig',
            [
                'user' => $user,
                'userSettingsForm' => $settingsForm,
            ]
        );
    }
}