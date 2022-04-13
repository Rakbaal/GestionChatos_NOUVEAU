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
    /**
     * @Route("/login", name="login")
     */
    public function Login(Request $request, ManagerRegistry $doctrine) : Response {
        $session = $request->getSession();

        if ($session->get('login' != null)) {
            $session->invalidate();
        }

        $utilisateur = new Utilisateur();
        $form = $this->createForm(loginType :: class, $utilisateur);
        $loginState = true;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $encoded = hash('sha256', $data->getUTIMDP());
            $entityManager = $doctrine->getManager();
            $exist = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['UTI_LOGIN' => $data->getUTILOGIN(), 'UTI_MDP' => $encoded]) != null;
            if ($exist) {
                $loginState = true;
                $utilisateur = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['UTI_LOGIN' => $data->getUTILOGIN(), 'UTI_MDP' => $encoded]);
                $session->set('login', $utilisateur->getUTILOGIN());
                $session->set('admin', $utilisateur->getUTIADMIN());
                
                return $this->redirect($this->generateUrl('Accueil'));
            } else {
                echo $encoded;
                $loginState = false;
            }
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView(),
            'loginState' => $loginState,
            'admin' => $session->get('admin')]
        );
    }
}
?>