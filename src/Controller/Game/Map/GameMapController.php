<?php

namespace App\Controller\Game\Map;

use App\Entity\Game\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/mapa/', name: 'app_game_map')]
class GameMapController extends AbstractController
{
    public function __invoke(Request $request, Game $game): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('frontend/game/map/map.html.twig', [
            'game' => $game,
            'helpText' => 'Na mapě si můžete vybrat minihru o surovinu kterou chcete získat. Stačí jen kliknout na ikonu minihry a vyčkat na načtení minihry. Pokud Vás zajíma jiný hrač, který je na stejné mapě, můžete kliknout na jeho vesnici a vidět informace o tomto hráči.',
            'helpTitle' => 'Mapa',
            'noFood' => $request->get('no-food') != null
        ]);
    }
}