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

    /**
     * @Route("listeUtilisateurs", name="listeUtilisateurs")
     */
    function listeUtilisateurs(ManagerRegistry $doctrine, Request $request)
    {
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listeUtilisateur = $entityManager->getRepository(Utilisateur::class)->findAll();
        
        $utilisateur = new Utilisateur();

        $form = $this->createForm(utilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $encoded = hash('sha256', $data->getUTIMDP());
            $utilisateur->setUTIMDP($encoded);     
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listeUtilisateurs"));
        }
        
        if ($session->get('login') && $session->get('admin')) {
            return $this->render('listeUtilisateurs.html.twig', [
                'listeUtilisateur' => $listeUtilisateur,
                'admin' => $session->get('admin'),
                'form' => $form -> createView()
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }        
    }

    /**
     * @Route("supprimerUtilisateur/{id}", name="supprimerUtilisateur")
     */
    public function SupprimerAnnonce(ManagerRegistry $doctrine, $id, Request $request) : Response {
        if ($request->getSession()->get('admin')) {
            $entityManager = $doctrine->getManager();
            $utilisateur = $entityManager->GetRepository(Utilisateur::class)->find($id);
            $entityManager->remove($utilisateur);
            $entityManager->flush($utilisateur);
        }

        return $this->redirect($this->generateUrl("listeUtilisateurs"));
    }

    /**
     * @Route("modifierutilisateur/{id}", name="modifierUtilisateur")
     */
    public function ModifierUtilisateur(Request $request, $id, ManagerRegistry $doctrine) : Response {
        $session = $request->getSession();
        $titre = "de l'utilisateur ".$id;
        $entityManager = $doctrine->getManager();
        $utilisateur = $entityManager->GetRepository(Utilisateur::class)->find($id);

        $form = $this->createForm(utilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $encoded = hash('sha256', $data->getUTIMDP());
            $utilisateur->setUTIMDP($encoded); 
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listeUtilisateurs"));
        }

        if ($session->get('login') && $session->get('admin')) {
            return $this->render("modifier.html.twig", [
                'titre' => $titre,
                'form' => $form->createView(),
                'listeUtilisateur' => $utilisateur,
                'admin' => $session->get('admin')
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
    }
}
?>