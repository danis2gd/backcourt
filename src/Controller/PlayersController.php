<?php
declare(strict_types=1);

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\Player;
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
 * Class PlayersController
 * @package App\Controller
 *
 * @Route(name="app_players_", path="/players")
 */
class PlayersController extends AbstractController
{
    /**
     * @Route(name="index", path="/")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        $players = $this->getDoctrine()
            ->getRepository(Player::class)
            ->findAll();

        return $this->render(
            'main/players/index.html.twig',
            [
                'players' => $players,
            ]
        );
    }

    /**
     * @Route(name="free_agency", path="/free_agency")
     *
     * @return Response
     */
    public function freeAgencyAction(): Response
    {
        $players = $this->getDoctrine()
            ->getRepository(Player::class)
            ->findAllFreeAgents();

        return $this->render(
            'main/players/free_agency.html.twig',
            [
                'players' => $players,
            ]
        );
    }

    /**
     * @Route(name="profile", path="/{name}")
     *
     * @param string $name
     *
     * @return Response
     */
    public function profileAction(string $name): Response
    {
        $player = $this->getDoctrine()
            ->getRepository(Player::class)
            ->findByName($name);

        return $this->render(
            'main/players/profile.html.twig',
            [
                'player' => $player,
            ]
        );
    }
}