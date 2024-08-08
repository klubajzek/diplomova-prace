<?php

namespace App\Controller\Game\MiniGame\Drag;

use App\Entity\Game\Game;
use App\Entity\MiniGames\Drag\MiniGameDragResult;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/pretahovacka/{miniGameId}/vysledek/', name: 'app_game_mini_game_drag_result')]
#[ParamConverter('matchResult', options: ['id' => 'miniGameId'])]
class MiniGameDragResultController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(MiniGameDragResult $matchResult, Game $game): Response
    {
        return $this->render('frontend/game/miniGame/drag/result.html.twig', [
            'matchResult' => $matchResult,
            'showBackToMap' => true,
            'game' => $game,
        ]);
    }
}