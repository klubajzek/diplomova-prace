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

#[Route(path: '/administrace/uzivatele/pridat/', name: 'app_administration_users_new')]
#[Route(path: '/administrace/uzivatele/{id}/upravit/', name: 'app_administration_users_edit')]
#[IsGranted('ROLE_ADMIN')]
class AdminUsersEditController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface      $entityManager,
                                private readonly EmailVerifier               $emailVerifier,
                                private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function __invoke(Request $request, User $user = null): Response
    {
        $isEdit = true;

        if ($user === null) {
            $isEdit = false;
            $user = new User();
        }

        $form = $this->createForm(RegistrationFormType::class, $user, [
            'isInAdmin' => true,
            'isEdit' => $isEdit
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->get('roles')->getData() === []) {
                $form->get('roles')->addError(new FormError('Musíte vybrat alespoň jednu roli!'));
            }

            if ($form->isValid()) {
                if (!$isEdit) {
                    $user->setPassword(
                        $this->userPasswordHasher->hashPassword(
                            $user,
                            $form->get('plainPassword')->getData()
                        )
                    );

                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    // generate a signed url and email it to the user
                    $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                        (new TemplatedEmail())
                            ->from(new Address('jakuburbanec@seznam.cz', 'Diplomová práce - Registrace'))
                            ->to($user->getEmail())
                            ->subject('Please Confirm your Email')
                            ->htmlTemplate('registration/confirmation_email.html.twig')
                    );
                }

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->redirectToRoute('app_administration_users_dashboard');
            }
        }

        return $this->render('frontend/administration/users/edit.html.twig', ['form' => $form->createView(),]);
    }
}