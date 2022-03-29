<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class deconnexionController extends AbstractController {

    /**
     * @Route("deconnexion", name="Deconnexion")
     */
    public function deconnexion(Request $request) {
        $session = $request->getSession();
        $session->invalidate();

        return $this->redirect($this->generateUrl("login"));
    }
}

?>