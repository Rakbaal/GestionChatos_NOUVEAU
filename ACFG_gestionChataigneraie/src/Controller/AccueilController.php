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
        $session = $request->getSession();
        $login = $session->get("login");
        return $this->render("accueil.html.twig", ['login' => $login]);
    }
}

?>