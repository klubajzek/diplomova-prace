<?php

namespace App\Controller\Admin\Match;

use App\Entity\MiniGames\Match\MiniGameMatchAnswer;
use App\Entity\MiniGames\Match\MiniGameMatchQuestion;
use App\Form\MiniGame\MatchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/spojovacka/pridat/', name: 'app_administration_match_new')]
#[Route(path: '/administrace/spojovacka/{id}/upravit/', name: 'app_administration_match_edit')]
#[IsGranted('ROLE_ADMIN')]
class AdminMatchEditController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, MiniGameMatchAnswer $answer = null): Response
    {
        $isEdit = true;

        if ($answer === null) {
            $isEdit = false;
            $answer = new MiniGameMatchAnswer();
        }

        $form = $this->createForm(MatchFormType::class, $answer);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->get('questionText')->getData() === []) {
                $form->get('questionText')->addError(new FormError('Zadejte text pro otázku!'));
            }

            if ($form->isValid()) {
                $question = $answer->getQuestion();
                if (!$isEdit) {
                    $question = new MiniGameMatchQuestion();
                    $question->setMiniGameMatchAnswer($answer);
                }

                $question->setQuestion($form->get('questionText')->getData());

                $this->entityManager->persist($answer);
                $this->entityManager->flush();

                return $this->redirectToRoute('app_administration_match_dashboard');
            }
        }

        return $this->render('frontend/administration/match/edit.html.twig', ['form' => $form->createView(),]);
    }
}