<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Vehicule;
use App\Entity\Agence;
use App\Entity\Carburant;
use App\Entity\Type;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehiculeImmatriculation', TextType::class, [
                'label' => 'Numéro d\'immatriculation',
                'help' =>'Le format doit etre de type XX-XXX-XX, en n\'oubliant pas les tirets ni les majuscules'
            ])
            ->add('vehiculeModele', TextType::class, [
                'label' => 'Modèle',
                'help' =>'Exemple : 308, Picasso, 2CV...'
            ])
            ->add('vehiculeMarque', TextType::class, [
                'label' => 'Marque',
            ])
            ->add('vehiculeEquipements', TextAreaType::class, [
                'label' => 'Equipements optionnels',
                'required' => false,
            ])
            ->add('vehiculeTailleReservoir', NumberType::class, [
                'label' => 'Volume total du réservoir (en litres)',
                'scale' => 2
            ])
            ->add('vehiculeDateAchat', DateType::class, [
                'label' => 'Date d\'achat du véhicule',
                'widget' => 'choice',
                'format' => 'd/M/y',
                'required' => true,
                'years' => range(date('y')-20, date('y')+48)
            ])
            ->add('vehiculeDateVente', DateType::class, [
                'label' => 'Date de vente',
                'widget' => 'choice',
                'format' => 'd/M/y',
                'required' => false,
                'years' => range(date('y'), date('y')+48)
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorieType', 
                'label' => 'Choisissez la catégorie de tarifs',
            ])
            ->add('agences', EntityType::class, [
                'class' => Agence::class,
                'choice_label' => 'agenceAdresse', 
                'label' => 'Choisissez l\'agence',
            ])
            ->add('carburants', EntityType::class, [
                'class' => Carburant::class,
                'choice_label' => 'carburantNom', 
                'label' => 'Choisissez le carburant',
            ])
            ->add('types', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'typeNom', 
                'label' => 'Choisissez le type de véhicule',
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
