<?php

namespace App\Controller\Game\Initialization;

use App\Entity\Game\Game;
use App\Entity\Game\GameProfile;
use App\Entity\User\User;
use App\Repository\User\GameProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateGameProfileController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private readonly GameProfileRepository  $gameProfileRepository)
    {
    }

    #[Route('/hra/{id}/game-profile/', name: 'create_new_game_profile', methods: ['POST'])]
    public function __invoke(Request $request, Game $game): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }

        $user = $this->getUser();

        if (!$user instanceof User) {
            return new JsonResponse([
                'success' => true,
                'url' => $this->generateUrl('app_login'
            )]);
        }

        if ($this->gameProfileRepository->findOneBy(['user' => $user])) {
            return new JsonResponse([
                'success' => true,
                'url' => $this->generateUrl('app_login',
            )]);
        }

        $position = $request->request->get('position');

        if (!$position) {
            throw $this->createNotFoundException();
        }

        $gameProfile = new GameProfile();
        $gameProfile
            ->setPosition($position)
            ->setGame($game)
            ->setUser($user);

        $this->entityManager->persist($gameProfile);
        $this->entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'url' => $this->generateUrl('app_game_village', ['id' => $gameProfile->getId()]
        )]);
    }
}