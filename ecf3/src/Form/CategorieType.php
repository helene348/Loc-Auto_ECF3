<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Jour;
use App\Entity\WeekEnd;
use App\Entity\Assurance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorieType')
            ->add('cautionPrix', MoneyType::class,[
                'label' => 'Prix de la caution',
            ])
            ->add('jours', EntityType::class, [
                'class' => Jour::class,
                'choice_label' => 'id', 
                'label' => 'Choisissez le tarif Jour pour cette catégorie',
            ])
            ->add('weekEnds', EntityType::class, [
                'class' => WeekEnd::class,
                'choice_label' => 'id', 
                'label' => 'Choisissez le tarif Week-end pour cette catégorie',
            ])
            ->add('assurance', EntityType::class, [
                'class' => Assurance::class,
                'choice_label' => 'id', 
                'label' => 'Choisissez le tarif Assurance pour cette catégorie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
