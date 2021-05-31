<?php

namespace App\Form;

use App\Entity\Reserver;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    private $vehiculeRepository;
    public function __construct(VehiculeRepository $vehiculeRepository)
    {
        $this->userRepository = $vehiculeRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehicule', EntityType::class, [
                'label' => 'Vehicule souhaité',
                'class' => Vehicule::class,
                //'choice' => $this->vehiculeRepository->findByDateVenteIsNull(),
                'choice_label' => function(Vehicule $vehicule) {
                    return sprintf('%s - %s', $vehicule->getVehiculeMarque(), $vehicule->getVehiculeModele());}
                //'disabled' => true,
            ])
            ->add('reservationDebutPrevu', DateTimeType::class, [
                'label' => 'Date et heure de prise du véhicule',
                'widget' => 'choice',
                'date_format' => 'dd-MM-yyyy',
                'years' => range(date('y'), date('y')+48),
                'hours' => range(9, 19),
                'minutes' => array(00, 15, 30, 45),
                'required' => true,
                'with_seconds' => false,
            ])
            ->add('reservationFinPrevue', DateTimeType::class, [
                'label' => 'Date et heure de rendu du véhicule',
                'widget' => 'choice',
                'date_format' => 'dd-MM-yyyy',
                'years' => range(date('y'), date('y')+48),
                'hours' => range(9, 19),
                'minutes' => array(00, 15, 30, 45),
                'required' => true,
                'with_seconds' => false,
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
