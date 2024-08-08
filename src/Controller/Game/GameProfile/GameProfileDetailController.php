<?php

namespace App\Controller\Game\GameProfile;

use App\Entity\Game\Game;
use App\Repository\MiniGames\Drag\MiniGameDragResultRepository;
use App\Repository\MiniGames\Match\MiniGameMatchResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/herni-profil/', name: 'app_game_profile_detail')]
class GameProfileDetailController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchResultRepository $miniGameMatchResultRepository,
                                private readonly MiniGameDragResultRepository  $miniGameDragResultRepository)
    {
    }

    public function __invoke(Request $request, Game $game): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $statsMatch = $this->miniGameMatchResultRepository->getGameProfileStats($user->getGameProfile());
        $statsDrag = $this->miniGameDragResultRepository->getGameProfileStats($user->getGameProfile());

        return $this->render('frontend/game/gameProfile/detail.html.twig', [
            'game' => $game,
            'user' => $user,
            'showBackToMap' => true,
            'statsMatch' => $statsMatch,
            'statsDrag' => $statsDrag,
            'miniGameMatches' => $this->miniGameMatchResultRepository->findBy(['gameProfile' => $user->getGameProfile()]),
            'miniGameDrags' => $this->miniGameDragResultRepository->findBy(['gameProfile' => $user->getGameProfile()]),
        ]);
    }
}