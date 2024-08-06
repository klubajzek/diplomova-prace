<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/uzivatel/profil/reaktivovat/', name: 'app_user_reactivate')]
#[IsGranted('ROLE_ADMIN')]
class UserReactivateController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->getUser();
        $user->setDeactivateInDate(null);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_user_profile');
    }
}