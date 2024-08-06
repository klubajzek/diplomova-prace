<?php

namespace App\Controller\Admin\Drag;

use App\Repository\MiniGames\Drag\MiniGameDragItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/pretahovacka/', name: 'app_administration_drag_dashboard')]
#[IsGranted('ROLE_ADMIN')]
class AdminDragDashboardController extends AbstractController
{
    public function __construct(private readonly MiniGameDragItemRepository $miniGameDragItemRepository)
    {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('frontend/administration/drag/dashboard.html.twig', [
            'items' => $this->miniGameDragItemRepository->findAll()
        ]);
    }
}