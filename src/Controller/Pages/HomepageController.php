<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route(path: '/', name: 'app_homepage')]
    public function __invoke(): Response
    {
        return $this->render('frontend/homepage/homepage.html.twig');
    }
}