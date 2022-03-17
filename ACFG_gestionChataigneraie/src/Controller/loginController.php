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
        $loginState = true;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager = $doctrine->getManager();
            $exist = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['UTI_LOGIN' => $data->getUTILOGIN(), 'UTI_MDP' => $data->getUTIMDP()]) != null;

            if ($exist) {
                $utilisateur = $entityManager->getRepository(Utilisateur :: class)->findOneBy(['UTI_LOGIN' => $data->getUTILOGIN(), 'UTI_MDP' => $data->getUTIMDP()]);
                $request->getSession()->set('login', $utilisateur->getUTILOGIN());
                $request->getSession()->set('admin', $utilisateur->getUTIMDP());


                return $this->redirect("accueil");
            } else {
                $loginState = false;
            }
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView(),
            'loginState' => $loginState]);
    }
}
?>