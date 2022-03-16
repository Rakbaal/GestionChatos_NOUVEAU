<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="Accueil")
     */
    public function accueil(Request $request) : Response {
        $login = $request->getSession()->get("login");
        return new Response("Bienvenue " . $login);
    }
}

?>