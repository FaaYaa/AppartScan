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

    #[Route('/appartInfo', name: 'appart.info')]
    public function appartInfo(): Response
    {
        return $this->render('pages/main/appart_info.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/EDLIP', name: 'EDL.info.principale')]
    public function EDLIP(): Response
    {
        return $this->render('pages/main/EDL_infos_principale.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }




    
    
}
