<?php

namespace App\Controller\Game\Detail;

use App\Entity\Game\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/detail/', name: 'app_game_detail')]
class GameDetailController extends AbstractController
{
    public function __invoke(Request $request, Game $game): Response
    {
        return $this->render('frontend/game/detail/detail.html.twig');
    }
}