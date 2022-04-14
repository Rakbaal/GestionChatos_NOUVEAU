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
            $entityManager->persist($personne);
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
}


?>