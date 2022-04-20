<?php 
namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Specialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class entrepriseType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('ENT_RS', TextType :: class , ['required' => false , 'label' => 'Raison Sociale :']) 
        ->add('ENT_VILLE', TextType :: class , ['required' => false , 'label' => 'Ville :'])
        ->add('ENT_PAYS', TextType :: class , ['required' => false , 'label' => 'Pays :'])
        //->add('specialites', EntityType :: class , ['required' => false , 'class' => Specialite :: class, 'choice_label' => 'SPE_LIBELLE', 'multiple' => true, 'expanded' => true])
        ->add('Rechercher', SubmitType :: class);
    }
}
?>