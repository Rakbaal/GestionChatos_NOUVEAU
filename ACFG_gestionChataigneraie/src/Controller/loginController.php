<?php 
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\utilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Persistence\ManagerRegistry;

class loginController extends AbstractController {
    /**
     * @Route("login", name="login")
     */
    function test(Request $request, ManagerRegistry $doctrine) {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(utilisateurType :: class, $utilisateur);
        $entityManager = $doctrine->getManager();
        $login = $utilisateur->getUTILOGIN();
        $mdp = $utilisateur->getUTIMDP();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $test = 'Utilisateur inexistant';
            
            if($entityManager->getRepository(Utilisateur :: class)->findOneBy(['uti_login' => $login])) {
                $session = new Session();
                $session->start();
                $session->set('login', $login);
                $test = 'Bonjour '.$login;
            }

            return new Response($test);
        }
        
        return $this->render('login.html.twig', ['form' => $form->createView()]);
    }
}
?>