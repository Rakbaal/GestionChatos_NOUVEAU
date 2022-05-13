<?php 
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class personneFiltreType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('PER_NOM', TextType :: class , ['required' => false , 'label' => 'Nom :']) 
        ->add('PER_PRENOM', TextType :: class , ['required' => false , 'label' => 'Prénom :'])
        ->add('Rechercher', SubmitType :: class);
    }
}
?>