<?php

namespace App\Controller\Game\MiniGame\Match;

use App\Repository\MiniGame\Match\MiniGameMatchAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/spojovacka/start', name: 'app_game_mini_game_match_start')]
class MiniGameMatchStartController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchAnswerRepository $miniGameMatchAnswerRepository)
    {
    }

    public function __invoke(): Response
    {
        return $this->render('frontend/game/miniGame/match/detail.html.twig', [
            'answers' => $this->miniGameMatchAnswerRepository->findRandom(10),
            'helpText' => 'Přiřaď správně odpovědi k otázkám.',
            'helpTitle' => 'Spojovací hra',
            'showBackToMap' => true,
        ]);
    }
}