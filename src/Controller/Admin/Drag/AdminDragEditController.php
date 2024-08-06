<?php

namespace App\Controller\Admin\Drag;

use App\Entity\MiniGames\Drag\MiniGameDragItem;
use App\Form\MiniGame\DragFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/pretahovacka/pridat/', name: 'app_administration_drag_new')]
#[Route(path: '/administrace/pretahovacka/{id}/upravit/', name: 'app_administration_drag_edit')]
#[IsGranted('ROLE_ADMIN')]
class AdminDragEditController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, MiniGameDragItem $item = null): Response
    {
        if ($item === null) {
            $item = new MiniGameDragItem();
        }

        $form = $this->createForm(DragFormType::class, $item);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($item);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_administration_drag_dashboard');
        }

        return $this->render('frontend/administration/drag/edit.html.twig', ['form' => $form->createView(),]);
    }
}