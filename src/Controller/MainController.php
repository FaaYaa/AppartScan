<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(): Response
    {
        return $this->render('pages/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    
}
