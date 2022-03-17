<?php 
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\utilisateurType;
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
        $utilisateur = new Utilisateur();
        $form = $this->createForm(utilisateurType :: class, $utilisateur);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // $entityManager = $doctrine->getManager();
            // $exist = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['uti_login' => $data->getUTILOGIN()]) != null;
            
            if (true) {
                $request->getSession()->set('login', $data->getUTILOGIN());
                return $this->redirect("accueil");
            }
            else {
                return new Response("L'utilisateur n'existe pas");
            }
        }
        
        return $this->render('login.html.twig', ['form' => $form->createView()]);
    }
}
?>