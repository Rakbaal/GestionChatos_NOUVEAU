<?php 
namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class entrepriseCompletType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('ENT_RS', TextType :: class, ['label' => 'Raison Sociale :'])
        ->add('ENT_VILLE', TextType :: class, ['label' => 'Ville :'])
        ->add('ENT_PAYS', TextType :: class, ['label' => 'Pays :'])
        ->add('ENT_ADRESSE', TextType :: class, ['label' => 'Adresse :'])
        ->add('ENT_CP', TextType :: class, ['label' => 'Code Postal :'])
        ->add('envoyer', SubmitType :: class, ['label' => 'Créer']);
    }
}
?>