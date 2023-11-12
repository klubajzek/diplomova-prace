<?php

namespace App\Controller\Registration;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationSuccessController extends AbstractController
{
    #[Route('/registrace/dokoceni/', name: 'app_register_success')]
    public function __invoke()
    {
        return $this->render('registration/success.html.twig');
    }
}