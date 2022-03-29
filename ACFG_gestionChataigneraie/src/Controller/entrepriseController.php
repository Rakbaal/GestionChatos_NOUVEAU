<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class entrepriseController extends AbstractController {

    /**
     * @Route("/listeEntreprises", name="listeEntreprises")
     */
    function listeEntreprises(ManagerRegistry $doctrine, Request $request)
    {
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        
        if ($session->get('login')) {
            return $this->render('listeEntreprises.html.twig', [
                'listeEntreprises' => $listeEntreprises,
                'admin' => $session->get('admin')
            ]);
        } else {
            return new Response("Accès refusé, veuillez vous authentifier à l'adresse 127.0.0.1:8000/login");
        }
        
    }
}
?>