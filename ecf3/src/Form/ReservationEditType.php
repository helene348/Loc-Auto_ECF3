<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Vehicule;
use App\Entity\Reserver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => function(Client $client) {
                    return sprintf('%s - %s - %s', $client->getId(), $client->getClientNom(), 
                $client->getClientMail());},
                'disabled' => true
            ])
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => function(Vehicule $vehicule) {
                    return sprintf('%s - %s (%s, %s)', $vehicule->getId(), $vehicule->getVehiculeImmatriculation(), 
                     $vehicule->getVehiculeModele(), $vehicule->getVehiculeMarque(),);},
                'disabled' => true
            ])
            ->add('reservationDebutPrevu', DateTimeType::class, [
                'widget' => 'choice',
                'date_format' => 'dd-MM-yyyy',
                'years' => range(date('y'), date('y')+48),
                'hours' => range(9, 19),
                'minutes' => array(00, 15, 30, 45),
                'required' => true,
                'with_seconds' => false,
                'disabled' => true
            ])
            ->add('reservationFinPrevue', DateTimeType::class, [
                'widget' => 'choice',
                'date_format' => 'dd-MM-yyyy',
                'years' => range(date('y'), date('y')+48),
                'hours' => range(9, 19),
                'minutes' => array(00, 15, 30, 45),
                'required' => true,
                'with_seconds' => false,
                'disabled' => true
            ])
            ->add('reservationDebutEffectif', DateTimeType::class, [
                'widget' => 'choice',
                'date_format' => 'dd-MM-yyyy',
                'years' => range(date('y'), date('y')+48),
                'hours' => range(9, 19),
                'minutes' => array(00, 15, 30, 45),
                'required' => true,
                'with_seconds' => false,
            ])
            ->add('reservationFinEffective', DateTimeType::class, [
                'widget' => 'choice',
                'date_format' => 'dd-MM-yyyy',
                'years' => range(date('y'), date('y')+48),
                'hours' => range(9, 19),
                'minutes' => array(00, 15, 30, 45),
                'required' => true,
                'with_seconds' => false,
            ])
            ->add('reservationKmDebut', NumberType::class, [
                'label' => 'Kilométrage au départ',
                'scale' => 0
            ])
            ->add('reservationKmFin', NumberType::class, [
                'label' => 'Kilométrage au retour',
                'scale' => 0
            ])
            ->add('reservationReservoirFin', NumberType::class, [
                'label' => 'Quantité de carburant dans le réservoir au retour',
                'scale' => 2
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reserver::class,
        ]);
    }
}
