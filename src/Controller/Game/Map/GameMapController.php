<?php

namespace App\Controller\Game\Map;

use App\Entity\Game\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/mapa/', name: 'app_game_map')]
class GameMapController extends AbstractController
{
    public function __invoke(Request $request, Game $game): Response
    {
        return $this->render('frontend/game/map/map.html.twig', [
            'game' => $game
        ]);
    }
}