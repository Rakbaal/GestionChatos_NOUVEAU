<?php 
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class utilisateurType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('UTI_LOGIN', TextType :: class, ['label' => 'Login :'])
        ->add('UTI_MDP', PasswordType :: class, ['label' => 'Mot de passe :'])
        ->add('UTI_ADMIN', ChoiceType :: class, ['label' => 'Droits d\'accès :','choices' => ['Administrateur'=>true,'Professeur'=>false]])
        ->add('Enregistrer', SubmitType :: class);
    }
}
?>