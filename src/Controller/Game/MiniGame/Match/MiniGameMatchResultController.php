<?php

namespace App\Controller\Game\MiniGame\Match;

use App\Entity\Game\Game;
use App\Entity\MiniGames\Match\MiniGameMatchResult;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/spojovacka/{miniGameId}/vysledek/', name: 'app_game_mini_game_match_result')]
#[ParamConverter('matchResult', options: ['id' => 'miniGameId'])]
class MiniGameMatchResultController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(MiniGameMatchResult $matchResult, Game $game): Response
    {
        return $this->render('frontend/game/miniGame/match/result.html.twig', [
            'matchResult' => $matchResult,
            'showBackToMap' => true,
            'game' => $game,
        ]);
    }
}