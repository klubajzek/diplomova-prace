<?php

namespace App\Controller\Admin\Match;

use App\Entity\MiniGames\Match\MiniGameMatchAnswer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/spojovacka/{id}/odstranit/', name: 'app_administration_match_remove')]
#[IsGranted('ROLE_ADMIN')]
class AdminMatchRemoveController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, MiniGameMatchAnswer $answer): Response
    {
        $this->entityManager->remove($answer);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_administration_match_dashboard');
    }
}