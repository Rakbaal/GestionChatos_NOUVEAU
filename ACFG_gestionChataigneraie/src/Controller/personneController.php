<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Entity\Entreprise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class personneController extends AbstractController {

    /**
     * @Route("/listePersonnes", name="listePersonnes")
     */
    function listePersonnes(ManagerRegistry $doctrine, Request $request)
    {
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listePersonne = $entityManager->getRepository(Personne::class)->findAll();

        if ($session->get('login')) {
            return $this->render('listePersonne.html.twig', [
                'listePersonne' => $listePersonne,
                'admin' => $session->get('admin')
            ]);
        } else {
            return new Response("Accès refusé, veuillez vous authentifier à l'adresse 127.0.0.1:8000/login");
        }
        
    }
}
?>