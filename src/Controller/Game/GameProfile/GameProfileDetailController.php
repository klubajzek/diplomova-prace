<?php

namespace App\Controller\Game\GameProfile;

use App\Entity\Game\Game;
use App\Entity\Game\GameProfile;
use App\Repository\MiniGames\Drag\MiniGameDragResultRepository;
use App\Repository\MiniGames\Match\MiniGameMatchResultRepository;
use App\Repository\User\GameProfileRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/herni-profil/{profileId}', name: 'app_game_profile_detail')]
#[ParamConverter('gameProfile', options: ['id' => 'profileId'])]
class GameProfileDetailController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchResultRepository $miniGameMatchResultRepository,
                                private readonly MiniGameDragResultRepository  $miniGameDragResultRepository,
                                private readonly GameProfileRepository         $gameProfileRepository)
    {
    }

    public function __invoke(Request $request, Game $game, GameProfile $gameProfile): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $statsMatch = $this->miniGameMatchResultRepository->getGameProfileStats($gameProfile);
        $statsDrag = $this->miniGameDragResultRepository->getGameProfileStats($gameProfile);

        return $this->render('frontend/game/gameProfile/detail.html.twig', [
            'game' => $game,
            'user' => $gameProfile->getUser(),
            'showBackToMap' => true,
            'statsMatch' => $statsMatch,
            'statsDrag' => $statsDrag,
            'miniGameMatches' => $this->miniGameMatchResultRepository->findBy(['gameProfile' => $gameProfile]),
            'miniGameDrags' => $this->miniGameDragResultRepository->findBy(['gameProfile' => $gameProfile]),
            'rank' => $gameProfile->getTotalScore() != null ? $this->gameProfileRepository->getUserRank($gameProfile->getUser()) : null,
        ]);
    }
}