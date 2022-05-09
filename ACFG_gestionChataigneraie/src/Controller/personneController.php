<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\personneType;

class personneController extends AbstractController {

    /**
     * @Route("/listePersonnes", name="listePersonnes")
     */
    function listePersonnes(ManagerRegistry $doctrine, Request $request)
    {
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listePersonne = $entityManager->getRepository(Personne::class)->findAll();

        $personne = new Personne();

        $form = $this->createForm(personneType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {     
            $data = $form->getData();  
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listePersonnes"));
        }
        if ($session->get('login')) {
            return $this->render('listePersonne.html.twig', [
                'listePersonne' => $listePersonne,
                'admin' => $session->get('admin'),
                'form' => $form -> createView()
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
        
    }

    /**
     * @Route("supprimerPersonne/{id}", name="supprimerPersonne")
     */
    function supprimerPersonne(ManagerRegistry $doctrine, $id, Request $request) {
        if ($request->getSession()->get('admin')) {
            $entityManager = $doctrine->getManager();
            $personne = $entityManager->getRepository(Personne::class)->find($id);
            $entityManager->remove($personne);
            $entityManager->flush($personne);
        }
        
        return $this->redirect($this->generateUrl('listePersonnes'));
    }

    /**
     * @Route("modifierPersonne/{id}", name="modifierPersonne")
     */
    function modifierPersonne(ManagerRegistry $doctrine, Request $request, $id) {
        $session = $request->getSession();
        $typeForm = "personne";
        $titre = "de la personne ".$id;
        $entityManager = $doctrine->getManager();
        $personne = $entityManager->getRepository(Personne::class)->find($id);
        $form = $this->createForm(personneType::class, $personne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirect($this->generateUrl("listePersonnes"));
        }

        if ($session->get('login') && $session->get('admin') == true) {
            return $this->render("modifier.html.twig", [
                'titre' => $titre, 
                'typeForm' => $typeForm,
                'formPersonne' => $form->createView(),
                'admin' => $session->get('admin')
            ]);
        } 
        else {
            return $this->render("erreurAcces.html.twig");
        }
    }
}


?>