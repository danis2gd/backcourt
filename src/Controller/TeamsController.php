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
 * @Route(name="app_teams_", path="/teams")
 */
class TeamsController extends AbstractController
{
    /**
     * @Route(name="index", path="/")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        $teams = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findAll();

        $team = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findOneById(
                $this->getUser()->getTeam()->getId()
            );

        return $this->render(
            'main/teams/index.html.twig',
            [
                'team' => $team,
                'teams' => $teams
            ]
        );
    }

    /**
     * @Route(name="create", path="/create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request) {
        $team = $this->getUser()->getTeam();

        if ($team instanceof Team) {
            return $this->redirectToRoute(
                'app_teams_profile',
                [
                    'teamName' => $team->getName()
                ]
            );
        }

        $form = $this->createForm(TeamType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->getUser() instanceof User) {
                return $this->redirectToRoute(
                    'app_error_404',
                    [
                        'errorMessage' => 'User not found.'
                    ]
                );
            }

            $team = Team::create($this->getUser(), $form->getData());

            $this->getDoctrine()->getManager()->persist($team);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(
                'app_teams_profile',
                [
                    'teamName' => $team->getName()
                ]
            );
        }

        return $this->render(
            'main/teams/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route(name="profile", path="/{teamName}")
     *
     * @param string $teamName
     *
     * @return Response
     */
    public function teamAction(string $teamName) {
        $team = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findOneByName($teamName);

        if (!$team instanceof Team) {
            return $this->render(
                'main/error/404.html.twig',
                [
                    'errorMessage' => sprintf('%s could not be found.', $teamName),
                ]
            );
        }

        return $this->render(
            'main/teams/team.html.twig',
            [
                'team' => $team,
            ]
        );
    }

    /**
     * @Route(name="roster", path="/{teamName}/roster")
     *
     * @param string $teamName
     *
     * @return Response
     */
    public function rosterAction(string $teamName) {
        $team = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findOneByName($teamName);

        if (!$team instanceof Team) {
            return $this->render(
                'main/error/404.html.twig',
                [
                    'errorMessage' => sprintf('%s could not be found.', $teamName),
                ]
            );
        }

        return $this->render(
            'main/teams/roster.html.twig',
            [
                'team' => $team,
            ]
        );
    }
}