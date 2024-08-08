<?php

namespace App\Controller\Game\MiniGame\Drag;

use App\Entity\Game\Game;
use App\Entity\MiniGames\Drag\MiniGameDragItem;
use App\Entity\MiniGames\Drag\MiniGameDragResult;
use App\Entity\MiniGames\Drag\MiniGameDragResultItem;
use App\Repository\MiniGames\Drag\MiniGameDragItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/pretahovacka/start', name: 'app_game_mini_game_drag_start')]
class MiniGameDragStartController extends AbstractController
{
    public function __construct(private readonly MiniGameDragItemRepository $miniGameDragAnswerRepository,
                                private readonly EntityManagerInterface        $entityManager)
    {
    }

    public function __invoke(Request $request, Game $game): Response
    {
        $user = $this->getUser();
        if ($user->getGameProfile()->getFood() < 1 && $request->get('resource') !== 'food') {
            $this->addFlash('error', 'Nemáš dostatek jídla pro spuštění minihry.');
            return $this->redirectToRoute('app_game_map', ['id' => $game->getId()]);
        }

        $dragItems = $this->miniGameDragAnswerRepository->findRandom(3);

        if ($dragItems === null) {
            $this->addFlash('error', 'Nemáte dostatek otázek pro spuštění minihry.');
            return $this->redirectToRoute('app_game_map', ['id' => $game->getId()]);
        }

        if ($user->getGameProfile()->getFood() > 0 && $request->get('resource') !== 'food'){
            $user->getGameProfile()->setFood($user->getGameProfile()->getFood() - 1);
        }

        $miniGame = new MiniGameDragResult();
        $miniGame->setGameProfile($this->getUser()->getGameProfile())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setResource($request->get('resource'));

        $dragItemParts = [];
        foreach ($dragItems as $dragItem) {
            $miniGameItem = new MiniGameDragResultItem();
            $miniGameItem->setDragItem($dragItem)
                ->setResult($miniGame);
            $this->entityManager->persist($miniGameItem);

            $dragItemParts[] = [
                'id' => $dragItem->getId(),
                'text' => $dragItem->getFirstPart(),
            ];

            $dragItemParts[] = [
                'id' => $dragItem->getId(),
                'text' => $dragItem->getSecondPart(),
            ];

            $dragItemParts[] = [
                'id' => $dragItem->getId(),
                'text' => $dragItem->getPartBetween(),
            ];

            $dragItemParts[] = [
                'id' => $dragItem->getId(),
                'text' => $dragItem->getAnswer(),
            ];
        }

        $this->entityManager->persist($user);
        $this->entityManager->persist($miniGame);
        $this->entityManager->flush();


        return $this->render('frontend/game/miniGame/drag/detail.html.twig', [
            'helpText' => 'V této hře jde o vytváření příkladů, vždy je třeba přesunout položky z levé strany vpravo a z nich poté skládat příklady. Ale pozor, po vyplnění všech zelených polí dojde ke kontrole a poté se všechny položky ztratí. Za každý správně složený příklad získáš 1 surovinu. Pokud už nevidíš žádný další možný příklad, který by šel složit, stačí kliknout na tlačítko přejít na výsledky. Souhrné výsledky nalezneš po dokončení hry.',
            'helpTitle' => 'Přetahovací hra',
            'game' => $game,
            'dragItemParts' => $dragItemParts,
            'miniGame' => $miniGame,
        ]);
    }
}