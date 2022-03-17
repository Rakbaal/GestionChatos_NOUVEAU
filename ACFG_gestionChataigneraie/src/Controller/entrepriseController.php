<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class entrepriseController extends AbstractController {

    /**
     * @Route("listeEntreprises", name="listeEntreprises")
     */
    function listeEntreprises(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        return $this->render('listeEntreprises.html.twig', ['listeEntreprises' => $listeEntreprises]);
    }
}
?>