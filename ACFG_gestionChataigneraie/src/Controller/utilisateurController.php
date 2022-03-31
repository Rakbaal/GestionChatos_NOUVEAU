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
            $password = hash('SHA256', 'password');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listeUtilisateurs"));
        }
        if ($session->get('login')) {
            return $this->render('listeUtilisateurs.html.twig', [
                'listeUtilisateur' => $listeUtilisateur,
                'admin' => $session->get('admin'),
                'form' => $form -> createView()
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
    }
}
?>