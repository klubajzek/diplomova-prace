<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route(path: '/o-aplikaci/', name: 'app_about')]
    public function __invoke(): Response
    {
        return $this->render('frontend/pages/about.html.twig');
    }
}