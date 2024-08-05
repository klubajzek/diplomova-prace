<?php

namespace App\Controller\Admin;

use App\Entity\Game\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/', name: 'app_administration_dashboard')]
#[IsGranted('ROLE_ADMIN')]
class AdminDashboardController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('frontend/administration/dashboard.html.twig');
    }
}