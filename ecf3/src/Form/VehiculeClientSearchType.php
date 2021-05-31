<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


// classe inutile (utilisée pour un essai pour chercher les véhicules par prix (pas finalisé))

class VehiculeClientSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'jours.jourPrix',
                'attr' => [
                    'placeholder' => 'Sélectionnez le tarif souhaité' 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
