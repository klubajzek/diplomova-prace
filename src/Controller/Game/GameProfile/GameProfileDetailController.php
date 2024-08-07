<?php

namespace App\Controller\Game\GameProfile;

use App\Entity\Game\Game;
use App\Repository\MiniGames\Match\MiniGameMatchResultRepository;
use App\Repository\User\GameProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/herni-profil/', name: 'app_game_profile_detail')]
class GameProfileDetailController extends AbstractController
{
    public function __construct(private readonly GameProfileRepository         $gameProfileRepository,
                                private readonly MiniGameMatchResultRepository $miniGameMatchResultRepository)
    {
    }

    public function __invoke(Request $request, Game $game): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $stats = $this->gameProfileRepository->getGameProfileStats($user->getGameProfile());

        return $this->render('frontend/game/gameProfile/detail.html.twig', [
            'game' => $game,
            'user' => $user,
            'showBackToMap' => true,
            'stats' => $stats,
            'miniGameMatches' => $this->miniGameMatchResultRepository->findBy(['gameProfile' => $user->getGameProfile()])
        ]);
    }
}