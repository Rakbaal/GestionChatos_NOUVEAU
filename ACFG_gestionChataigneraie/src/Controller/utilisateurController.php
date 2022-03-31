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
        return $this->render('listeUtilisateurs.html.twig', [
            'listeUtilisateur' => $listeUtilisateur,
            'admin' => $session->get('admin')
        ]);
    }
    public function AjouterUtilisateur(Request $request) : Response {
        $utilisateur = new Utilisateur();

        $form = $this->createForm(utilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($message);
            $doctrine->flush($message);
        }

        return $this->render('listeUtilisateurs.html.twig', ['form' => $form->createView() ]);
    }
}
?>