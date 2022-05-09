<?php 
namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Profil;
use App\Entity\Fonction;
use App\Entity\Entreprise;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class personneFiltreType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('PER_NOM', TextType :: class , ['required' => false , 'label' => 'Nom :']) 
        ->add('PER_PRENOM', TextType :: class , ['required' => false , 'label' => 'Prénom :'])
        ->add('fonctions', EntityType::class, [
            'class' => Fonction :: class, 
            'choice_label' => 'FON_LIBELLE', 
            'multiple' => true, 
            //'expanded' => false,
            'required' => false,
        ])
        ->add('profils', EntityType::class, [
            'class' => Profil :: class, 
            'choice_label' => 'PRO_TYPE', 
            'multiple' => true, 
            //'expanded' => false,
            'required' => false,
        ])
        // ->add('fonctions', TextType :: class , ['required' => false , 'label' => 'Fonctions :'])
        ->add('Rechercher', SubmitType :: class);
    }
}
?>