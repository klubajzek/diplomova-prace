<?php

namespace App\Controller\Game\Start;

use App\Repository\MiniGame\Match\MiniGameMatchAnswerRepository;
use App\Repository\MiniGame\Match\MiniGameMatchQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minigame/', name: 'app_game_start_mini_game')]
class GameStartController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchQuestionRepository $miniGameMatchQuestionRepository,
                                private readonly MiniGameMatchAnswerRepository   $miniGameMatchAnswerRepository)
    {
    }

    public function __invoke(): Response
    {
        return $this->render('frontend/miniGame/match/detail.html.twig', [
            'questions' => $this->miniGameMatchQuestionRepository->findAll(),
            'answers'   => $this->miniGameMatchAnswerRepository->findAll()
        ]);
    }
}