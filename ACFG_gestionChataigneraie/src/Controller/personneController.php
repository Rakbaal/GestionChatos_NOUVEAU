<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\personneType;
use App\Form\personneFiltreType;

class personneController extends AbstractController {

    // Liste les personnes existantes. En tant qu'administrateur, donne accès à la suppression 
    // et la création de personnes.
    /**
     * @Route("/listePersonnes", name="listePersonnes")
     */
    function listePersonnes(ManagerRegistry $doctrine, Request $request)
    {
        // Récupération des variables de session, et récupération des personnes
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listePersonne = $entityManager->getRepository(Personne::class)->findAll();
        
        // Initialisation d'un formulaire de filtre
        $personne = new Personne();
        $formFiltre = $this->createForm(personneFiltreType :: class, $personne);
        $formFiltre->handleRequest($request);

        // Initialisation d'un formulaire de création d'une personne (privilège admin)
        $personne2 = new Personne();
        $formNouveau = $this->createForm(personneType :: class, $personne2);
        $formNouveau->handleRequest($request);
        
        // Si le formulaire de filtre est soumis et valide, un filtre est appliqué
        // à la liste des personnes
        if($formFiltre->isSubmitted() && $formFiltre->isValid()) {
            $data = $formFiltre->getData();
            
            // Récupération de la liste des personnes selon la base du filtre
            $entityManager = $doctrine->getManager();
            $listePersonnesFiltre = $entityManager->getRepository(Personne::class)->findByPersonneFiltre($data);
        
            return $this->render('listePersonne.html.twig', [
                'formFiltre' => $formFiltre->createView(),
                'formNouveau' => $formNouveau->createView(),
                'listePersonne' => $listePersonnesFiltre,
                'admin' => $session->get('admin')
            ]);
        }
        
        // Si le formulaire de création de personne est soumis et valide, crée la personne en base de données
        if ($formNouveau->isSubmitted() && $formNouveau->isValid()) {     
            $data = $formNouveau->getData();  
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listePersonnes"));
        }
        // Détermine si le visiteur est bien authentifié avant de donner accès à la liste
        if ($session->get('login')) {
            return $this->render('listePersonne.html.twig', [
                'formFiltre' => $formFiltre->createView(),
                'formNouveau' => $formNouveau->createView(),
                'listePersonne' => $listePersonne,
                'admin' => $session->get('admin'),
            ]);
        } else {
            // Si le visiteur n'est pas authentifié il est renvoyé vers une page d'erreur
            return $this->render("erreurAcces.html.twig");
        }
        
    }

    // Permet la suppression d'une personne sur la base de son id
    /**
     * @Route("supprimerPersonne/{id}", name="supprimerPersonne")
     */
    function supprimerPersonne(ManagerRegistry $doctrine, $id, Request $request) {
        // Détermine si le visiteur est bien un administrateur pour procéder
        // à la suppression d'une personne
        if ($request->getSession()->get('admin')) {
            $entityManager = $doctrine->getManager();
            $personne = $entityManager->getRepository(Personne::class)->find($id);
            $entityManager->remove($personne);
            $entityManager->flush($personne);
        }
        
        // Renvoie vers la liste mise à jour de personnes
        return $this->redirect($this->generateUrl('listePersonnes'));
    }

    // Permet la modification des informations d'une personne en base de données
    /**
     * @Route("modifierPersonne/{id}", name="modifierPersonne")
     */
    function modifierPersonne(ManagerRegistry $doctrine, Request $request, $id) {
        // Récupère les variables de session et récupère les informations de la personne
        // concernée par la modification
        $session = $request->getSession();
        $typeForm = "personne";
        $titre = "de la personne ".$id;
        $entityManager = $doctrine->getManager();
        $personne = $entityManager->getRepository(Personne::class)->find($id);
        $form = $this->createForm(personneType::class, $personne);

        $form->handleRequest($request);

        // Si le formulaire de modification est soumis et validé, enregistre la personne créée
        // en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listePersonnes"));
        }

        // Vérifie que le visiteur est bien un administrateur avant de donner accès à la page de modification
        if ($session->get('login') && $session->get('admin') == true) {
            return $this->render("modifier.html.twig", [
                'titre' => $titre, 
                'typeForm' => $typeForm,
                'formPersonne' => $form->createView(),
                'admin' => $session->get('admin')
            ]);
        } 
        else {
            // Si le visiteur n'est pas un administrateur, renvoie une page d'erreur
            return $this->render("erreurAcces.html.twig");
        }
    }
}


?>