<?php

namespace App\Controller\Game\Detail;

use App\Entity\Game\GameProfile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/detail/', name: 'app_game_detail')]
class GameDetailController extends AbstractController
{
    public function __invoke(Request $request, GameProfile $gameProfile): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('frontend/game/detail/detail.html.twig', [
            'gameProfile' => $gameProfile
        ]);
    }
}