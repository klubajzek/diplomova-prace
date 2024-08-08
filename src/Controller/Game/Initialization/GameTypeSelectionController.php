<?php

namespace App\Controller\Game\Initialization;

use App\Entity\Game\Game;
use App\Form\Game\GameStartType;
use App\Repository\Game\GameRepository;
use App\Service\Game\UniqueCodeGeneratorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/start/', name: 'app_game_select_type')]
class GameTypeSelectionController extends AbstractController
{
    public function __construct(private readonly UniqueCodeGeneratorService $uniqueCodeGeneratorService,
                                private readonly EntityManagerInterface     $entityManager,
                                private readonly GameRepository             $gameRepository)
    {
    }

    /**
     * @return RedirectResponse
     */
    public
    function __invoke(Request $request): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $type = $request->get('type');
        $game = new Game();

        $form = $this->createForm(GameStartType::class, $game, [
            'action' => $this->generateUrl('app_game_select_type'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($type == null) {
                return $this->redirectToRoute('app_game_select_type');
            }

            if ($type == 'find' && $game->getCode() == '') {
                $form->get('code')->addError(new FormError('Zadejte prosím kód hry'));
            }

            if ($type == 'find' && $game->getCode() != '') {
                $game = $this->gameRepository->findOneBy(['code' => $game->getCode(), 'isDeactivated' => false]);

                if ($game === null) {
                    $form->get('code')->addError(new FormError('Hra s tímto kódem neexistuje'));
                } elseif ($game->getGameProfiles()->count() == 3) {
                    $form->get('code')->addError(new FormError('Hra je již plná'));
                } else {
                    return $this->redirectToRoute('app_game_map_initialization', ['id' => $game->getId()]);
                }
            }

            if ($form->isValid()) {
                $code = ($this->uniqueCodeGeneratorService)();
                $game->setCode($code);

                $this->entityManager->persist($game);
                $this->entityManager->flush();

                return $this->redirectToRoute('app_game_map_initialization', ['id' => $game->getId()]);
            }
        }

        $showStartModal = !isset($_COOKIE['showStartModal']);

        if ($showStartModal) {
            setcookie('showStartModal', '', time() - 3600, '/');
        }

        return $this->render('frontend/game/start/start.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'showStartModal' => $showStartModal
        ]);
    }
}