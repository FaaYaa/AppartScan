<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Form\LocationTypeEdit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationController extends AbstractController
{
    
    #[Route('/location', name: 'app_location')]
    public function index(EntityManagerInterface $entityManager,KernelInterface $kernel): Response
    {
        $imagesDir = $kernel->getProjectDir().'/public';
        $user = $this->getUser();
        $locations = $entityManager->getRepository(Location::class)->findBy(['user' => $user]);
        
        return $this->render('pages/location/index.html.twig', [
            'controller_name' => 'LocationController',
            'locations' => $locations,
            'imagesDir' =>$imagesDir

        ]);
    }

     /**
     * This controller allow us to register 
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/location/create', name: 'app_location_create')]
    public function create(EntityManagerInterface $entityManager, Request $request,  KernelInterface $kernel): Response
    {
        $imagesDir = $kernel->getProjectDir().'/public';
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $this->getUser();
            $location->setUser($user);
            
            // Gestion de l'image
            $image = $form->get('image')->getData();
            if ($image) {
                $imageName = bin2hex(random_bytes(6)) . '.' . $image->getClientOriginalExtension();
                $image->move($imagesDir, $imageName);
                $location->setImage($imageName);
            }

            $this->addFlash(
                'success',
                'Votre bien a bien été créé.'
            );

            $entityManager->persist($location);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'La location a bien été créée.'
            );

            return $this->redirectToRoute('app_location');
        }

        return $this->render('pages/location/create.html.twig', [
            'form' => $form,
            'location' => $location,
        ]);
    }

    #[Route('/location/{id}/edit', name: 'app_location_edit')]
    public function edit(EntityManagerInterface $entityManager, Request $request, $id, KernelInterface $kernel): Response
    {
    $location = $entityManager->getRepository(Location::class)->find($id);
    if (!$location) {
        throw $this->createNotFoundException(
            'Aucune location trouvée pour l\'id ' . $id
        );
    }

    $nom = $request->request->get('nom');
    $adresse = $request->request->get('adresse');
    $image = $request->files->get('image');
    $nbreRadiateur = $request->request->get('NbreRadiateur');
    $chaudiere = $request->request->get('Chaudiere');
    $chauffeEau = $request->request->get('ChauffeEau');

    if ($nom && $adresse) {
        $location->setNom($nom);
        $location->setAdresse($adresse);
        $location->setNbreRadiateur($nbreRadiateur);
        
        if (!$chaudiere) {
            $location->setChaudiere(false);
        }else {
            $location->setChaudiere($chaudiere);   
        }
        if (!$chauffeEau) {
            $location->setChauffeEau(false);
        }
        else {
            $location->setChauffeEau($chauffeEau);
        }


        if ($image) {
            $imagesDir = $kernel->getProjectDir().'/public';
            $imageName = bin2hex(random_bytes(6)) . '.' . $image->getClientOriginalExtension();
            $image->move($imagesDir, $imageName);
            $location->setImage($imageName);
        }

        $entityManager->flush();

        $this->addFlash(
            'success',
            'La location a bien été modifiée.'
        );

        return $this->redirectToRoute('app_location');
    }

    return $this->render('pages/location/edit.html.twig', [
        'location' => $location,
    ]);
    }

   
}
