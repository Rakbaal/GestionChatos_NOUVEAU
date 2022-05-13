<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\utilisateurType;

class utilisateurController extends AbstractController {

    // Affiche la liste des utilisateurs au visiteur (Privilège admin)
    /**
     * @Route("listeUtilisateurs", name="listeUtilisateurs")
     */
    function listeUtilisateurs(ManagerRegistry $doctrine, Request $request)
    {
        // Récupère les informations de session et la liste des utilisateurs
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listeUtilisateur = $entityManager->getRepository(Utilisateur::class)->findAll();
        
        $utilisateur = new Utilisateur();

        // instancie le formulaire de création d'utilisateur
        $form = $this->createForm(utilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        // Si le formulaire est soumis et validé, renvoie la liste des utilisateurs
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $encoded = hash('sha256', $data->getUTIMDP());
            $utilisateur->setUTIMDP($encoded);     
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listeUtilisateurs"));
        }
        
        // Vérifie que l'utilisateur est authentifié et qu'il s'agit d'un administrateur avant de renvoyer vers la 
        // liste des utilisateurs
        if ($session->get('login') && $session->get('admin')) {
            return $this->render('listeUtilisateurs.html.twig', [
                'listeUtilisateur' => $listeUtilisateur,
                'admin' => $session->get('admin'),
                'form' => $form -> createView()
            ]);
        } else {
            // Si l'utilisateur n'est pas un administrateur, renvoie une page d'erreur
            return $this->render("erreurAcces.html.twig");
        }        
    }

    // Permet de supprimer un utilisateur sur la base de son id
    /**
     * @Route("supprimerUtilisateur/{id}", name="supprimerUtilisateur")
     */
    public function SupprimerUtilisateur(ManagerRegistry $doctrine, $id, Request $request) : Response {
        // Vérifie que l'utilisateur est un administrateur avant de procéder à la suppression
        // d'un utilisateur en base de données
        if ($request->getSession()->get('admin')) {
            $entityManager = $doctrine->getManager();
            $utilisateur = $entityManager->GetRepository(Utilisateur::class)->find($id);
            $entityManager->remove($utilisateur);
            $entityManager->flush($utilisateur);
        }

        // Renvoie vers la liste des utilisateurs mise à jour
        return $this->redirect($this->generateUrl("listeUtilisateurs"));
    }

    // Permet de modifier les informations d'un utilisateur sur la base de son id
    /**
     * @Route("modifierutilisateur/{id}", name="modifierUtilisateur")
     */
    public function ModifierUtilisateur(Request $request, $id, ManagerRegistry $doctrine) : Response {
        // Récupère les variables de sessions et instancie un objet
        // contenant les informations de l'utilisateur concerné
        $session = $request->getSession();
        $typeForm = "utilisateur";
        $titre = "de l'utilisateur ".$id;
        $entityManager = $doctrine->getManager();
        $utilisateur = $entityManager->GetRepository(Utilisateur::class)->find($id);

        // Instancie le formulaire de modification d'un utilisateur
        $form = $this->createForm(utilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide, modifie les informations de l'utilisateur en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $encoded = hash('sha256', $data->getUTIMDP());
            $utilisateur->setUTIMDP($encoded); 
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listeUtilisateurs"));
        }

        // Si l'utilisateur est bien un administrateur, renvoie vers la page de modification d'un utilisateur
        if ($session->get('login') && $session->get('admin') == true) {
            return $this->render("modifier.html.twig", [
                'titre' => $titre, 
                'typeForm' => $typeForm,
                'formUtilisateur' => $form->createView(),
                'admin' => $session->get('admin')
            ]);
        }
        else {
            // Si l'utilisateur n'est pas un administrateur, renvoie vers une page d'erreur
            return $this->render("erreurAcces.html.twig");
        }
    }
}
?>