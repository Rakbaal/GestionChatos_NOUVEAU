<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Form\entrepriseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class entrepriseController extends AbstractController {

    /**
     * @Route("/listeEntreprises", name="listeEntreprises")
     */
    function listeEntreprises(ManagerRegistry $doctrine, Request $request)
    {
        // Execute une requête pour afficher toutes les entreprises dans le tableau
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        

        // Création du formulaire pour le filtrage
        $entreprise = new Entreprise();
        $form = $this->createForm(entrepriseType :: class, $entreprise);
        $form->handleRequest($request);

        // Si l'utilisateur clique sur 'Rechercher'
        if($form->isSubmitted() && $form->isValid()) {
            // Récupération des valeurs des textbox saisies
            $data = $form->getData();

            // Execute une requête pour afficher les entreprises respectant les critères voulus
            $entityManager = $doctrine->getManager();
            $listeEntreprisesFiltre = $entityManager->getRepository(Entreprise::class)->findByEntrepriseFiltre($data/*$data->getENTRS(),  $data->getENTVILLE(), $data->getENTPAYS() , $data->getSpecialites()*/);
        
            // Retourne la liste des entreprises concernées par les critères
            return $this->render('listeEntreprises.html.twig', [
                'form' => $form->createView(),
                'listeEntreprises' => $listeEntreprisesFiltre,
                'admin' => $session->get('admin')
            ]);
        }

        // Retourne la liste entière des entreprises
        return $this->render('listeEntreprises.html.twig', [
            'form' => $form->createView(),
            'listeEntreprises' => $listeEntreprises,
            'admin' => $session->get('admin')
        ]);

    }

    /**
     * @Route("supprimerEntreprise/{id}", name="supprimerEntreprise")
     */
    function supprimerEntreprise(ManagerRegistry $doctrine, $id) {
        $entityManager = $doctrine->getManager();
        $entreprise = $entityManager->getRepository(Entreprise::class)->find($id);
        $entityManager->remove($entreprise);
        $entityManager->flush($entreprise);
        
        return $this->redirect($this->generateUrl('listeEntreprises'));
    }
}
?>