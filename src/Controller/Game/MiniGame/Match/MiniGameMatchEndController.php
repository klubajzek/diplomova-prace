<?php

namespace App\Controller\Game\MiniGame\Match;

use App\Entity\Game\Game;
use App\Entity\MiniGames\Match\MiniGameMatchResultItem;
use App\Entity\MiniGames\Match\MiniGameMatchResult;
use App\Repository\MiniGames\Match\MiniGameMatchAnswerRepository;
use App\Repository\MiniGames\Match\MiniGameMatchQuestionRepository;
use App\Repository\MiniGames\Match\MiniGameMatchResultItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/hra/{id}/minihra/spojovacka/{miniGameId}/konec/', name: 'app_game_mini_game_match_end')]
#[ParamConverter('matchResult', options: ['id' => 'miniGameId'])]
class MiniGameMatchEndController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchAnswerRepository     $miniGameMatchAnswerRepository,
                                private readonly MiniGameMatchQuestionRepository   $miniGameMatchQuestionRepository,
                                private readonly MiniGameMatchResultItemRepository $miniGameMatchResultItemRepository,
                                private readonly EntityManagerInterface            $entityManager)
    {
    }

    public function __invoke(Request $request, MiniGameMatchResult $matchResult, Game $game): JsonResponse
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
                $question = $this->miniGameMatchQuestionRepository->find($mistake['question']);
                $answer = $this->miniGameMatchAnswerRepository->find($mistake['answer']);
                $item = $this->miniGameMatchResultItemRepository->findOneBy(['result' => $matchResult->getId(), 'question' => $question->getId()]);

                if (!$item instanceof MiniGameMatchResultItem) {
                    continue;
                }

                $item
                    ->setMistakeAnswer($answer)
                    ->setMistakeAnswerText($answer->getAnswer());
                $this->entityManager->persist($item);
                $countMistakes++;
            }
        }

        $countCorrects = 0;
        if ($corrects) {
            foreach ($corrects as $correct) {
                $question = $this->miniGameMatchQuestionRepository->find($correct['question']);
                $item = $this->miniGameMatchResultItemRepository->findOneBy(['result' => $matchResult->getId(), 'question' => $question->getId()]);

                if (!$item instanceof MiniGameMatchResultItem) {
                    continue;
                }

                $item
                    ->setIsFilled(true);
                $this->entityManager->persist($item);
                $countCorrects++;
            }
        }

        if ($countMistakes + $countCorrects > 10) {
            $matchResult->setMistakes(10);
        } else {
            $matchResult
                ->setMistakes($countMistakes)
                ->setCorrectAnswers($countCorrects)
                ->setNotFilled(10 - $countMistakes - $countCorrects);
            $gameProfile = $user->getGameProfile();
            $gameProfile->setTotalMistakes($gameProfile->getTotalMistakes() + $countMistakes);
            $gameProfile->setTotalCorrectAnswers($gameProfile->getTotalCorrectAnswers() + $countCorrects);
            $gameProfile->setTotalFilled($gameProfile->getTotalFilled() + (10 - $countMistakes - $countCorrects));
            $gameProfile->setTotalScore($gameProfile->getTotalCorrectAnswers() > 0 ? round($gameProfile->getTotalCorrectAnswers() / ($gameProfile->getTotalMistakes() + $gameProfile->getTotalCorrectAnswers() + $gameProfile->getTotalFilled()), 2) : 0);
            $value = floor(intval($countCorrects) / 3);
            switch ($matchResult->getResource()) {
                case 'food':
                    $gameProfile->setFood($gameProfile->getFood() + $value);
                    break;
                case 'wood':
                    $gameProfile->setWood($gameProfile->getWood() + $value);
                    break;
                case 'stone':
                    $gameProfile->setStone($gameProfile->getStone() + $value);
                    break;
            }
        }

        $this->entityManager->persist($matchResult);
        $this->entityManager->flush();

        return new JsonResponse(['success' => true, 'url' => $this->generateUrl('app_game_mini_game_match_result', ['id' => $game->getId(), 'miniGameId' => $matchResult->getId()])]);
    }
}