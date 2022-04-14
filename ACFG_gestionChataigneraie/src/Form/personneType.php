<?php 
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Profil;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class personneType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('PER_NOM', TextType :: class, ['label' => 'Nom :'])
        ->add('PER_PRENOM', TextType :: class, ['label' => 'Prénom :'])
        ->add('PER_MAIL', TextType :: class, ['label' => 'Mail :'])
        ->add('PER_TEL_PERSO', NumberType :: class, ['label' => 'Téléphone :'])
        ->add('PER_TEL_PRO', NumberType :: class, ['label' => 'Téléphone professionnel :'])
        ->add('profils', EntityType::class, ['class' => Profil :: class, 'choice_label' => 'PRO_TYPE', 'multiple' => true, 'expanded' => true])
        ->add('envoyer', SubmitType :: class, ['label' => 'Créer']);
    }
}
?>