<?php

namespace App\Form;

use App\Entity\WeekEnd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class WkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wkPrix', MoneyType::class, [
                'label' => 'Prix par jour',
                'currency' => 'EUR'
            ])
            ->add('wkKmPrix', MoneyType::class,[
                'label' => 'Prix par km',
            ])
            ->add('wkDebut', TimeType::class,[
                'label' => 'Heure de démarrage du tarif',
                'input_format' => 'string',
                        'hours' => range(7, 19),
                        'minutes' => array(00, 15, 30, 45),
                'help' => 'Ce tarif correspond à l\'heure de début de la journée de location'
            ])
            ->add('wkFin', TimeType::class,[
                'label' => 'Heure de fin du tarif',
                'input_format' => 'string',
                        'hours' => range(7, 19),
                        'minutes' => array(00, 15, 30, 45),
                'help' => 'Ce tarif correspond à l\'heure de fin de la journée de location'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeekEnd::class,
        ]);
    }
}
