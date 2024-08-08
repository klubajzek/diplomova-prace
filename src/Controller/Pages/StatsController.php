<?php

namespace App\Controller\Pages;

use App\Repository\User\GameProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    public function __construct(private readonly GameProfileRepository $gameProfileRepository)
    {
    }

    #[Route(path: '/statistiky/', name: 'app_stats')]
    public function __invoke(): Response
    {
        $stats = $this->gameProfileRepository->getStats();
        return $this->render('frontend/pages/stats.html.twig', [
            'stats' => $this->gameProfileRepository->getStats(),
        ]);
    }
}