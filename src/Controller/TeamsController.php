<?php

namespace App\Controller;

use App\Classes\Fetcher\DepthChartFetcher;
use App\Classes\Saver\DepthChartSaver;
use App\DTO\DepthChartDTO;
use App\DTO\UserDTO;
use App\Entity\DepthChart;
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
 * Class TeamsController
 * @package App\Controller
 *
 * @Route(name="app_teams_", path="/teams")
 */
class TeamsController extends AbstractController
{
    /**
     * @var DepthChartFetcher
     */
    private $depthChartFetcher;

    /**
     * @var DepthChartSaver
     */
    private $depthChartSaver;

    public function __construct(DepthChartFetcher $depthChartFetcher, DepthChartSaver $depthChartSaver)
    {
        $this->depthChartFetcher = $depthChartFetcher;
        $this->depthChartSaver = $depthChartSaver;
    }

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

        return $this->render(
            'main/teams/index.html.twig',
            [
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

    /**
     * @Route(name="depth_chart", path="/{teamName}/depth_chart")
     *
     * @param string $teamName
     *
     * @return Response
     */
    public function depthChartAction(string $teamName) {
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
            'main/teams/depth_chart.html.twig',
            [
                'team' => $team,
            ]
        );
    }

    /**
     * @Route(name="depth_chart_save", path="/{teamName}/depth_chart/save", methods={"POST"}, options={"expose": true})
     *
     * @param string $teamName
     * @param Request $request
     *
     * @return Response
     */
    public function depthChartSaveAction(string $teamName, Request $request) {
        $team = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findOneByName($teamName);

        if (!$team instanceof Team) {
            return new Response('invalid team');
        }

        if (!$team instanceof Team) {
            return new Response('invalid user team');
        }

        if ($this->getUser()->getUuid() !== $team->getUser()->getUuid()) {
            return new Response('not your team');
        }

        $rawDepthChart = $request->get('depthChart');
        $nullableDepthChart = [];

        dump($rawDepthChart);

        for ($i = 0; $i < DepthChart::MAX_ROSTER; $i++) {
            $nullableDepthChart[$i] = isset($rawDepthChart[$i]) ? $rawDepthChart[$i] : null;
        }

        $depthChartData = array_combine(DepthChart::$depthChart, $nullableDepthChart);

        $depthChartDTO = new DepthChartDTO();
        $depthChartDTO->populate(
            $this->depthChartFetcher->fetch($depthChartData)
        );

        $this->depthChartSaver->save($team, $depthChartDTO);

        return new Response('success');
    }

    /**
     * @Route(name="schedule", path="/{teamName}/schedule")
     *
     * @param string $teamName
     *
     * @return Response
     */
    public function scheduleAction(string $teamName) {
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
            'main/teams/schedule.html.twig',
            [
                'team' => $team,
            ]
        );
    }
}