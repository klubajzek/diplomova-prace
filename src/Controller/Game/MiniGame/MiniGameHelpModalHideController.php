<?php

namespace App\Controller\Game\MiniGame;

use App\Entity\Game\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/zrusit-modal/', name: 'app_game_mini_game_modal_hide')]
class MiniGameHelpModalHideController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, Game $game): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }

        $user = $this->getUser();

        if ($user === null) {
            return new JsonResponse();
        }

        $type = $request->get('type');

        if ($type === '') {
            return new JsonResponse();
        }

        switch ($type) {
            case 'match':
                $user->getGameProfile()->setHideMatchHelpModal(true);
                break;
            case 'drag':
                $user->getGameProfile()->setHideDragHelpModal(true);
                break;
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse();
    }
}