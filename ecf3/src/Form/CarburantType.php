<?php

namespace App\Form;

use App\Entity\Carburant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarburantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carburantNom', TextType::class, [
                'label' => 'Nom',
                'help' => 'Le nom ne doit pas faire plus de 30 caractères'
            ])
            ->add('carburantPrix', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'EUR',
                'help' => 'Le prix doit être plus élevé que le prix du carburant officiel'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carburant::class,
        ]);
    }
}
