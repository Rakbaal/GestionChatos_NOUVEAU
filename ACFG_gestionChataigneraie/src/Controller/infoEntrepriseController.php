<?php
namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\Personne;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


class infoEntrepriseController extends AbstractController
{
    /**
     * @Route("/infoEntreprise/{id}", name="infoEntreprise")
     */
    public function infoEntreprise($id, ManagerRegistry $doctrine, Request $request){
        $session = $request->getSession();
        $entityManager = $doctrine->getManager();
        $Entreprise = $entityManager->getRepository(Entreprise::class)->find($id);
        $listePersonne = $Entreprise->getPersonnes();

        if ($session->get('login')) {
            return $this->render("infoEntreprise.html.twig ", [
                "Entreprises" => $Entreprise,
                "listePersonne" => $listePersonne,
                "admin" => $session->get('admin')
            ]);
        } else {
            return $this->render("erreurAcces.html.twig");
        }
        
    }
}

?>