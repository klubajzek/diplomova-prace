<?php

namespace App\Controller\Game\Village;

use App\Entity\Game\GameProfile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/vesnice/', name: 'app_game_village')]
class VillageDetailController extends AbstractController
{
    public function __invoke(Request $request, GameProfile $gameProfile): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $buildingsEntity = $gameProfile->getGameProfileBuildings();
        $buildings = [];

        if ($buildingsEntity->count() > 0) {
            foreach ($buildingsEntity as $building) {
                $buildings[$building->getPosition()] = $building->getType();
            }
        }

        return $this->render('frontend/game/detail/detail.html.twig', [
            'gameProfile' => $gameProfile,
            'showBackToMap' => true,
            'buildings' => $buildings,
            'helpTitle' => 'Vesnice',
            'helpText' => 'Ve vesnici můžete stavět budovy, které Vám umožní později postupovat dále příběhem. <br> 
                Typy budov:<br>
                <ol>
                <li>Hlavní budova: Ubytuje 5 obyvatel, je centerem vesnice. Cena: 5 kamene a 5 dřeva</li>
                <li>Dům: Slouží k ubytování obyvatel. Cena: 1 kámen a 2 dřeva</li>
                <li>Stodola: Slouží k uchování většího množství surovin. Cena: 2 kameny a 3 dřeva</li>
            </ol>',
        ]);
    }
}