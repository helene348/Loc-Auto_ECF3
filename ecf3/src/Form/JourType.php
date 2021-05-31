<?php

namespace App\Form;

use App\Entity\Jour;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jourPrix', MoneyType::class, [
                'label' => 'Prix par jour',
                'currency' => 'EUR'
            ])
            ->add('jourKmPrix', MoneyType::class,[
                'label' => 'Prix par km',
            ])
            ->add('jourDebut', TimeType::class,[
                'label' => 'Heure de démarrage du tarif',
                'input_format' => 'string',
                        'hours' => range(7, 19),
                        'minutes' => array(00, 15, 30, 45),
                'help' => 'Ce tarif correspond au début de la journée de location'
            ])
            ->add('jourFin', TimeType::class,[
                'label' => 'Heure de fin du tarif',
                'input_format' => 'string',
                        'hours' => range(7, 19),
                        'minutes' => array(00, 15, 30, 45),
                'help' => 'Ce tarif correspond à la fin de la journée de location'
            ])
            ->add('jourRemise', PercentType::class, [
                'label' => 'Remise pour 3 jours ou plus de location (en pourcentage)',
                'required' => false,
                'type' => 'integer',
                'help' => 'Cette remise ne prend pas en compte le carburant et les week-ends'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jour::class,
        ]);
    }
}
