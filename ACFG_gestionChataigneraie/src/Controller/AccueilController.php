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

        // Si le visiteur est authentifié, renvoie vers l'accueil
        if ($session->get('login')) {
            return $this->render("accueil.html.twig ", [
                'login' =>$session->get('login'),
                'admin' => $session->get('admin')
            ]);
        // Si le visiteur n'est pas authentifié, renvoie une page d'erreur
        } else {
            return $this->render("erreurAcces.html.twig");
        }
    }
}

?>