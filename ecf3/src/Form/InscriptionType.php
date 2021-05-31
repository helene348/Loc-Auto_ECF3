<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientNom', TextType::class)
            ->add('clientAdresse', TextareaType::class)
            ->add('clientMail', EmailType::class, [
                'help' => 'Veuillez respecter le format type x@x.x'
            ])
            ->add('clientTelephone', TelType::class)
            ->add('clientLogin', TextType::class)
            ->add('clientMdp', PasswordType::class, [
                'help' => 'Votre mot de passe doit faire au moins 8 caractères',
            ])
            ->add('confirmMdp', PasswordType::class)
            ->add('clientNumeroPermis', TextType::class)
            ->add('clientValiditePermis', DateType::class, [
                'label' => 'Date de validité du permis',
                'widget' => 'choice',
                'format' => 'd-M-y',
                'required' => false,
                'years' => range(date('y'), date('y')+48),
                'help' => 'Si votre permis n\'a pas de date de validité, laissez la date vide',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
