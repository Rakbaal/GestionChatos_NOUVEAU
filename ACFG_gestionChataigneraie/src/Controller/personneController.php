<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

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
            return $this->render("erreurAcces.html.twig");
        }
        
    }

    /**
     * @Route("supprimerPersonne/{id}", name="supprimerPersonne")
     */
    function supprimerPersonne(ManagerRegistry $doctrine, $id) {
        $entityManager = $doctrine->getManager();
        $personne = $entityManager->getRepository(Personne::class)->find($id);
        $entityManager->remove($personne);
        $entityManager->flush($personne);
        
        return $this->redirect($this->generateUrl('listePPersonnes'));
    }
}
?>