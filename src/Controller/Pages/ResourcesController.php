<?php

namespace App\Controller\Pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResourcesController extends AbstractController
{
    #[Route(path: '/zdroje/', name: 'app_resources')]
    public function __invoke(): Response
    {
        return $this->render('frontend/pages/resources.html.twig');
    }
}