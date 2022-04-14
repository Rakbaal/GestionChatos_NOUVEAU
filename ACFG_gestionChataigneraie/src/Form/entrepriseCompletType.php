<?php 
namespace App\Form;

use App\Entity\Specialite;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class entrepriseCompletType extends AbstractType {
    function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('ENT_RS', TextType :: class, ['label' => 'Raison Sociale :'])
        ->add('ENT_ADRESSE', TextType :: class, ['label' => 'Adresse :'])
        ->add('ENT_CP', TextType :: class, ['label' => 'Code Postal :'])
        ->add('ENT_VILLE', TextType :: class, ['label' => 'Ville :'])
        ->add('ENT_PAYS', TextType :: class, ['label' => 'Pays :'])
        ->add('specialites', EntityType::class, ['class' => Specialite :: class, 'choice_label' => 'SPE_LIBELLE', 'multiple' => true, 'expanded' => true])
        ->add('envoyer', SubmitType :: class, ['label' => 'Enregistrer']);
    }
}
?>