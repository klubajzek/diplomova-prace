<?php

namespace App\Controller\Game\MiniGame\Drag;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/pretahovacka/start', name: 'app_game_mini_game_drag_start')]
class MiniGameDragStartController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(): Response
    {
        return $this->render('frontend/game/miniGame/drag/detail.html.twig', [
            'helpText' => 'Vytvořte správně příklady.',
            'helpTitle' => 'Přetahovací hra',
            'showBackToMap' => true,
        ]);
    }
}