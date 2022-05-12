<?php 
namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Fonction;
use Symfony\Component\Form\AbstractType;
use App\Entity\Profil;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class personneType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('PER_NOM', TextType :: class, ['label' => 'Nom :'])
        ->add('PER_PRENOM', TextType :: class, ['label' => 'Prénom :'])
        ->add('PER_MAIL', TextType :: class, ['label' => 'Mail :'])
        ->add('PER_TEL_PERSO', TextType :: class, [
            'label' => 'Téléphone perso:',
            'required' => false
        ])
        ->add('PER_TEL_PRO', TextType :: class, [
                'label' => 'Téléphone pro :',
                'required' => false
            ])
        ->add('entreprise', EntityType::class, [
            'class' => Entreprise :: class,
            'choice_label' => 'ENT_RS',
            'required' => false
            ])
        ->add('fonctions', EntityType::class, [
                'class' => Fonction :: class, 
                'choice_label' => 'FON_LIBELLE', 
                'multiple' => true, 
                'expanded' => true,
                'required' => false
            ])
        ->add('profils', EntityType::class, [
                'class' => Profil :: class, 
                'choice_label' => 'PRO_TYPE', 
                'multiple' => true, 
                'expanded' => true,
                'required' => false
        ])
        ->add('envoyer', SubmitType :: class, ['label' => 'Enregistrer']);
    }
}
?>