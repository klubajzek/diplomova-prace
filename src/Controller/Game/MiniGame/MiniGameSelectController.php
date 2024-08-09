<?php

namespace App\Controller\Game\MiniGame;

use App\Entity\Game\Game;
use App\Repository\MiniGames\Drag\MiniGameDragItemRepository;
use App\Repository\MiniGames\Match\MiniGameMatchAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/vybrat/', name: 'app_game_mini_game_select')]
class MiniGameSelectController extends AbstractController
{
    public function __construct(private readonly MiniGameDragItemRepository    $miniGameDragItemRepository,
                                private readonly MiniGameMatchAnswerRepository $miniGameMatchAnswerRepository)
    {
    }

    public function __invoke(Request $request, Game $game): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        if ($user->getGameProfile()->getFood() < 1 && $request->get('resource') !== 'food') {
            $this->addFlash('error', 'Nemáš dostatek jídla pro spuštění minihry.');
            return $this->redirectToRoute('app_game_map', ['id' => $game->getId(), 'no-food' => true]);
        }

        return $this->render('frontend/game/miniGame/select.html.twig', [
            'game' => $game,
            'type' => $request->get('type'),
            'showBackToMap' => true,
            'helpText' => 'Zde si můžete vybrat minihru, kterou chcete hrát, stačí kliknout na tlačítko vybrat minihru. Pozor, za každou minihru, která není o jídlo se platí 1 jídlo.',
            'helpTitle' => 'Vyber minihru',
            'resource' => $request->get('resource'),
            'matchShow' => $this->miniGameMatchAnswerRepository->findRandom(1) != [],
            'dragShow' => $this->miniGameDragItemRepository->findRandom(1) != []
        ]);
    }
}