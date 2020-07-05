<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlayersController
 * @package App\Controller
 *
 * @Route(name="app_games_", path="/games")
 */
class GameController extends AbstractController
{
    /**
     * @Route(name="game", path="/{id}")
     *
     * @param int $id
     *
     * @return Response
     */
    public function gameAction(int $id): Response
    {
        $game = $this->getDoctrine()
            ->getRepository(Game::class)
            ->findOneBy(['id' => $id]);

        if (!$game instanceof Game) {
            $this->redirectToRoute('app_homepage');
        }

        return $this->render(
            'main/game/game.html.twig',
            [
                'game' => $game,
            ]
        );
    }
}