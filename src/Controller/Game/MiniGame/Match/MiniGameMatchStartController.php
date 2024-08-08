<?php

namespace App\Controller\Game\MiniGame\Match;

use App\Entity\Game\Game;
use App\Entity\MiniGames\Match\MiniGameMatchResult;
use App\Entity\MiniGames\Match\MiniGameMatchResultItem;
use App\Repository\MiniGames\Match\MiniGameMatchAnswerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/spojovacka/start', name: 'app_game_mini_game_match_start')]
class MiniGameMatchStartController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchAnswerRepository $miniGameMatchAnswerRepository,
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

    $answers = $this->miniGameMatchAnswerRepository->findRandom(10);

    if ($answers === null) {
        $this->addFlash('error', 'Nemáte dostatek otázek pro spuštění minihry.');
        return $this->redirectToRoute('app_game_map', ['id' => $game->getId()]);
    }

    if ($user->getGameProfile()->getFood() > 0 && $request->get('resource') !== 'food'){
        $user->getGameProfile()->setFood($user->getGameProfile()->getFood() - 1);
    }


    $miniGame = new MiniGameMatchResult();
    $miniGame->setGameProfile($this->getUser()->getGameProfile())
        ->setCreatedAt(new \DateTimeImmutable())
        ->setResource($request->get('resource'));

    foreach ($answers as $answer) {
        $miniGameItem = new MiniGameMatchResultItem();
        $miniGameItem->setQuestion($answer->getQuestion())
            ->setQuestionText($answer->getQuestion()->getQuestion())
            ->setAnswer($answer)
            ->setAnswerText($answer->getAnswer())
            ->setResult($miniGame);
        $this->entityManager->persist($miniGameItem);
    }

    $this->entityManager->persist($user);
    $this->entityManager->persist($miniGame);
    $this->entityManager->flush();

    return $this->render('frontend/game/miniGame/match/detail.html.twig', [
        'answers' => $answers,
        'helpText' => 'V této hře jde o to, aby jsi propojil správně příklad s odpovědí. Stačí kliknout na příklad a poté na odpověď, která si myslíš, že by to mohla být. Podle správnosti se zbarví pozadí odpovědi a po chvilce zmízí. Za každé 3 správné odpovědi získáš danou surovinu. Souhrné výsledky nalezneš po dokončení hry.',
        'helpTitle' => 'Spojovací hra',
        'miniGame' => $miniGame,
        'game' => $game,
    ]);
}
}