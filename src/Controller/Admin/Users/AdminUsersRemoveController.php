<?php

namespace App\Controller\Admin\Users;

use App\Entity\User\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/administrace/uzivatele/{id}/odstranit/', name: 'app_administration_users_remove')]
#[IsGranted('ROLE_ADMIN')]
class AdminUsersRemoveController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface      $entityManager)
    {
    }

    public function __invoke(Request $request, User $user = null): Response
    {
        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $user->deactivate();

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_administration_users_dashboard');
    }
}