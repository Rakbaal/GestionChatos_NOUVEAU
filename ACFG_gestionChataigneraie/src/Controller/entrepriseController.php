<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Form\entrepriseCompletType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class entrepriseController extends AbstractController {

    /**
     * @Route("/listeEntreprises", name="listeEntreprises")
     */
    function listeEntreprises(ManagerRegistry $doctrine, Request $request){
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(Entreprise::class)->findAll();

        $entreprise = new Entreprise();
        $form = $this->createForm(entrepriseCompletType :: class, $entreprise);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirect($this->generateUrl("listeEntreprises"));
        }

        if ($session->get('login')) {
            return $this->render('listeEntreprises.html.twig', [
                'form' => $form->createView(),
                'listeEntreprises' => $listeEntreprises,
                'admin' => $session->get('admin')
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
        
    }

    /**
     * @Route("listeEntreprisesFiltre/{rs}{ville}{pays}{specialite}", name="listeEntreprisesFiltre")
     */
    function listeEntreprisesFiltre(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $listeEntreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        return $this->render('listeEntreprises.html.twig', ['listeEntreprises' => $listeEntreprises]);
    }
}
?>