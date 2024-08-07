<?php

namespace App\Controller\Admin\Match;

use App\Repository\MiniGames\Match\MiniGameMatchAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/spojovacka/', name: 'app_administration_match_dashboard')]
#[IsGranted('ROLE_ADMIN')]
class AdminMatchDashboardController extends AbstractController
{
    public function __construct(private readonly MiniGameMatchAnswerRepository $miniGameMatchAnswerRepository)
    {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('frontend/administration/match/dashboard.html.twig', [
            'answers' => $this->miniGameMatchAnswerRepository->findAll()
        ]);
    }
}