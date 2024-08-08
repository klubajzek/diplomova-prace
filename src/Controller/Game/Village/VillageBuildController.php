<?php

namespace App\Controller\Game\Village;

use App\Entity\Game\GameProfile;
use App\Entity\Game\GameProfileBuilding;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/vesnice/postavit/', name: 'app_game_village_build')]
class VillageBuildController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, GameProfile $gameProfile): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }

        $building = $request->get('building');
        $position = $request->get('position');

        if ($building === null) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Není vybrána žádná budova',
            ]);
        }

        if ($position === null) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Není vybráno místo',
            ]);
        }

        $canBuild = false;
        $people = 0;
        switch ($building) {
            case 'mainBuilding':
                if ($gameProfile->getWood() >= 5 && $gameProfile->getStone() >= 5) {
                    $canBuild = true;
                    $gameProfile->setWood($gameProfile->getWood() - 5);
                    $gameProfile->setStone($gameProfile->getStone() - 5);
                    $people = 5;
                }

                break;
            case 'house':
                if ($gameProfile->getWood() >= 2 && $gameProfile->getStone() >= 1) {
                    $canBuild = true;
                    $gameProfile->setWood($gameProfile->getWood() - 2);
                    $gameProfile->setStone($gameProfile->getStone() - 1);
                    $people = 1;
                }
                break;
            case 'barn':
                if ($gameProfile->getWood() >= 3 && $gameProfile->getStone() >= 2) {
                    $canBuild = true;
                    $gameProfile->setWood($gameProfile->getWood() - 3);
                    $gameProfile->setStone($gameProfile->getStone() - 2);
                }
                break;
        }

        if (!$canBuild) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Budova nebyla postavena',
            ]);
        }

        $buildingEntity = new GameProfileBuilding();
        $buildingEntity->setGameProfile($gameProfile)
            ->setType($building)
            ->setPosition($position)
            ->setPeople($people);

        $this->entityManager->persist($buildingEntity);
        $this->entityManager->persist($gameProfile);
        $this->entityManager->flush();


        return new JsonResponse([
            'success' => true,
            'message' => 'Budova byla postavena',
        ]);
    }
}