<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class personneController extends AbstractController {

    /**
     * @Route("listePersonnes", name="listeListePersonnes")
     */
    function listePersonnes(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listePersonne = $entityManager->getRepository(Personne::class)->findAll();
        return $this->render('listePersonne.html.twig', ['listePersonne' => $listePersonne]);
    }
}
?>