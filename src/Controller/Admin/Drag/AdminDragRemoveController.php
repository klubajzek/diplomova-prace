<?php

namespace App\Controller\Admin\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/pretahovacka/{id}/odstranit/', name: 'app_administration_drag_remove')]
#[IsGranted('ROLE_ADMIN')]
class AdminDragRemoveController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, MiniGameDragItem $item): Response
    {
        $this->entityManager->remove($item);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_administration_drag_dashboard');
    }
}