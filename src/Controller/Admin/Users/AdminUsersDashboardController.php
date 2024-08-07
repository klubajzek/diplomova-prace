<?php

namespace App\Controller\Admin\Users;

use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/uzivatele/', name: 'app_administration_users_dashboard')]
#[IsGranted('ROLE_ADMIN')]
class AdminUsersDashboardController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('frontend/administration/users/dashboard.html.twig', [
            'users' => $this->userRepository->findBy(['isDeactivated' => false])
        ]);
    }
}