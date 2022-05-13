<?php 
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\loginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class loginController extends AbstractController {

    // Permet l'authentification des différents visiteurs de l'application
    /**
     * @Route("/login", name="login")
     */
    public function Login(Request $request, ManagerRegistry $doctrine) : Response {
        $session = $request->getSession();

        // Si une session était en cours, cette dernière est annulée
        if ($session->get('login' != null)) {
            $session->invalidate();
        }

        $utilisateur = new Utilisateur();
        $form = $this->createForm(loginType :: class, $utilisateur);
        $loginState = true;

        $form->handleRequest($request);

        // Si le formulaire de connexion est soumis et valide, vérifie
        // que le paire login/mot de passe existe
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $encoded = hash('sha256', $data->getUTIMDP());
            $entityManager = $doctrine->getManager();
            $exist = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['UTI_LOGIN' => $data->getUTILOGIN(), 'UTI_MDP' => $encoded]) != null;
            
            // Si la paire existe, une session est démarrée à son nom en fonction de ses droits d'accès
            if ($exist) {
                $loginState = true;
                $utilisateur = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['UTI_LOGIN' => $data->getUTILOGIN(), 'UTI_MDP' => $encoded]);
                $session->set('login', $utilisateur->getUTILOGIN());
                $session->set('admin', $utilisateur->getUTIADMIN());
                
                return $this->redirect($this->generateUrl('Accueil'));
            
            // Si la paire n'existe pas, affiche un message d'erreur de connexion
            } else {
                
                $loginState = false;
            }
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView(),
            'loginState' => $loginState,
            'admin' => $session->get('admin')]
        );
    }

    // Permet à un visiteur de mettre fin à sa session
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