<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GDPRController extends AbstractController
{
    #[Route(path: '/ochrana-osobnich-udaju/', name: 'app_gdpr')]
    public function __invoke(): Response
    {
        return $this->render('frontend/pages/gdpr.html.twig');
    }
}