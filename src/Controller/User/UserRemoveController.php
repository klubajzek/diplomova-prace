<?php

namespace App\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/uzivatel/profil/odstranit/', name: 'app_user_remove')]
#[IsGranted('ROLE_ADMIN')]
class UserRemoveController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request): Response
    {
        $date = new \DateTimeImmutable();
        $user = $this->getUser();

        $user->setDeactivateInDate($date->modify('+2 day'));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_user_profile');
    }
}