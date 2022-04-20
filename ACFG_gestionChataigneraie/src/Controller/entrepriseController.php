<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Form\entrepriseType;
use App\Form\entrepriseCompletType;
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

        // Execute une requête pour afficher toutes les entreprises dans le tableau
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(Entreprise::class)->findAll();

        // Création du formulaire pour le filtrage
        $entreprise = new Entreprise();
        $formFiltre = $this->createForm(entrepriseType :: class, $entreprise);
        $formFiltre->handleRequest($request);

        // Création du formulaire pour l'ajout d'une entreprise
        $entreprise2 = new Entreprise();
        $formNouveau = $this->createForm(entrepriseCompletType :: class, $entreprise2);
        $formNouveau->handleRequest($request);

        // Si l'utilisateur clique sur 'Rechercher'
        if($formFiltre->isSubmitted() && $formFiltre->isValid()) {
            // Récupération des valeurs des textbox saisies
            $data = $formFiltre->getData();

            // Execute une requête pour afficher les entreprises respectant les critères voulus
            $entityManager = $doctrine->getManager();
            $listeEntreprisesFiltre = $entityManager->getRepository(Entreprise::class)->findByEntrepriseFiltre($data);
        
            // Retourne la liste des entreprises concernées par les critères
            return $this->render('listeEntreprises.html.twig', [
                'formFiltre' => $formFiltre->createView(),
                'formNouveau' => $formNouveau->createView(),
                'listeEntreprises' => $listeEntreprisesFiltre,
                'admin' => $session->get('admin')
            ]);
        }
        
        if($formNouveau->isSubmitted() && $formNouveau->isValid()) {
            $data = $formNouveau->getData();
            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirect($this->generateUrl("listeEntreprises"));
        }

        if ($session->get('login')) {
            return $this->render('listeEntreprises.html.twig', [
                'formFiltre' => $formFiltre->createView(),
                'formNouveau' => $formNouveau->createView(),
                'listeEntreprises' => $listeEntreprises,
                'admin' => $session->get('admin')
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }

    }

    /**
     * @Route("supprimerEntreprise/{id}", name="supprimerEntreprise")
     */
    function supprimerEntreprise(ManagerRegistry $doctrine, $id, Request $request) {
        if ($request->getSession()->get('admin')) {
            $entityManager = $doctrine->getManager();
            $entreprise = $entityManager->getRepository(Entreprise::class)->find($id);
            $entityManager->remove($entreprise);
            $entityManager->flush($entreprise);
        }
        
        return $this->redirect($this->generateUrl('listeEntreprises'));
    }

    /**
     * @Route("modifierEntreprise/{id}", name="modifierEntreprise")
     */
    function modifierEntreprise(ManagerRegistry $doctrine, Request $request, $id) {
        $session = $request->getSession();
        $titre = "de l'entreprise ".$id;
        $entityManager = $doctrine->getManager();
        $entreprise = $entityManager->getRepository(Entreprise::class)->find($id);
        $form = $this->createForm(entrepriseCompletType::class, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listeEntreprises"));
        }

        if ($session->get('login') && $session->get('admin') == true) {
            return $this->render("modifier.html.twig", [
                'titre' => $titre, 
                'form' => $form->createView(),
                'admin' => $session->get('admin')
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
    }

    /**
     * @Route("/infoEntreprise/{id}", name="infoEntreprise")
     */
    public function infoEntreprise($id, ManagerRegistry $doctrine, Request $request){
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $entreprise = $entityManager->getRepository(Entreprise::class)->find($id);
        $listePersonne = $entreprise->getPersonnes();

        if ($session->get('login')) {
            return $this->render("infoEntreprise.html.twig", [
                "entreprise" => $entreprise,
                "listePersonne" => $listePersonne,
                "admin" => $session->get('admin')
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
    }
}
?>