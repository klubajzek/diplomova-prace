<?php

namespace App\Controller\Game\MiniGame\Drag;

use App\Entity\Game\Game;
use App\Entity\MiniGames\Drag\MiniGameDragResult;
use App\Entity\MiniGames\Drag\MiniGameDragResultItemCorrect;
use App\Entity\MiniGames\Drag\MiniGameDragResultItemMistake;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/pretahovacka/{miniGameId}/konec/', name: 'app_game_mini_game_drag_end')]
#[ParamConverter('matchResult', options: ['id' => 'miniGameId'])]
class MiniGameDragEndController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, MiniGameDragResult $matchResult, Game $game): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException();
        }

        $user = $this->getUser();

        $mistakes = $request->get('mistakes');
        $corrects = $request->get('corrects');

        $countMistakes = 0;
        if ($mistakes) {
            foreach ($mistakes as $mistake) {
                $item = new MiniGameDragResultItemMistake();
                $item
                    ->setResult($matchResult)
                    ->setFirstPart($mistake['firstValue'])
                    ->setBetweenPart($mistake['betweenValue'])
                    ->setSecondPart($mistake['secondValue'])
                    ->setAnswer($mistake['answer']);

                $this->entityManager->persist($item);
                $countMistakes++;
            }
        }

        $countCorrects = 0;
        if ($corrects) {
            foreach ($corrects as $correct) {
                $item = new MiniGameDragResultItemCorrect();
                $item
                    ->setResult($matchResult)
                    ->setFirstPart($correct['firstValue'])
                    ->setBetweenPart($correct['betweenValue'])
                    ->setSecondPart($correct['secondValue'])
                    ->setAnswer($correct['answer']);

                $this->entityManager->persist($item);
                $countCorrects++;
            }
        }

        if ($countMistakes + $countCorrects > 3) {
            $matchResult->setMistakes(3);
        } else {
            $matchResult
                ->setMistakes($countMistakes)
                ->setCorrectAnswers($countCorrects)
                ->setNotFilled(3 - $countMistakes - $countCorrects);
            $value = $countCorrects;
            switch ($matchResult->getResource()) {
                case 'food':
                    $user->getGameProfile()->setFood($user->getGameProfile()->getFood() + $value);
                    break;
                case 'wood':
                    $user->getGameProfile()->setWood($user->getGameProfile()->getWood() + $value);
                    break;
                case 'stone':
                    $user->getGameProfile()->setStone($user->getGameProfile()->getStone() + $value);
                    break;
            }
        }

        $this->entityManager->persist($matchResult);
        $this->entityManager->flush();

        return new JsonResponse(['success' => true, 'url' => $this->generateUrl('app_game_mini_game_drag_result', ['id' => $game->getId(), 'miniGameId' => $matchResult->getId()])]);
    }
}