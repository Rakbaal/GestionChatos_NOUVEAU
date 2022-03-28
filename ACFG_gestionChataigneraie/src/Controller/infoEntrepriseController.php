<?php
namespace App\Controller;

use App\Entity\Entreprise;
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
    public function infoEntreprise($id, ManagerRegistry $doctrine){
        $entityManager = $doctrine->getManager();
        $Entreprises = $entityManager->getRepository(Entreprise::class)->find($id);
        return $this->render("infoEntreprise.html.twig ", ["Entreprises" => $Entreprises]);
    }
}

?>