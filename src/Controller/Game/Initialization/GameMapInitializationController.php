<?php

namespace App\Controller\Game\Initialization;

use App\Entity\Game\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/pocatecni-mapa/', name: 'app_game_map_initialization')]
class GameMapInitializationController extends AbstractController
{
    /**
     * @return RedirectResponse
     */
    public function __invoke(Game $game): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $gameProfiles = $game->getGameProfiles();
        $positions = [];
        if ($gameProfiles->count() > 0) {
            foreach ($gameProfiles as $gameProfile) {
                $positions[$gameProfile->getPosition()] = $gameProfile->getPosition();
            }
        }

        return $this->render('frontend/game/start/map.html.twig', [
            'user' => $user,
            'game' => $game,
            'positions' => $positions,
        ]);
    }
}