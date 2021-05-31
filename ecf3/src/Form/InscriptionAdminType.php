<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class InscriptionAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientInscription', DateType::class, [
                'label' => 'Date d\'inscription',
                'format' => 'd/M/y',
                'disabled' => true
            ])

            ->add('clientNom', TextType::class, [
                'label' => 'Prénom et nom',
                'disabled' => true
            ])
            
            //liste déroulante pour changer le choix de rôle (format pas correct)
            /*
            ->add('clientRole', ChoiceType::class, [
                'label' => 'Role',
                
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'Client' => 'ROLE_USER',
                  'Admin' => 'ROLE_ADMIN',
                ],
            ])
            */
            ->add('clientAdresse', TextareaType::class, [
                'label' => 'Adresse',
                'disabled' => true
            ])
            ->add('clientMail', EmailType::class, [
                'label' => 'Adresse mail',
                'disabled' => true
            ])
            ->add('clientTelephone', TelType::class, [
                'label' => 'Numéro de téléphone',
                'disabled' => true
            ])
            ->add('clientLogin', TextType::class, [
                'label' => 'Login',
                'disabled' => true
            ])
            ->add('clientMdp', PasswordType::class, [
                'label' => 'Mot de passe',
                'disabled' => true
            ])
            ->add('clientNumeroPermis', TextType::class, [
                'label' => 'Numéro de permis',
                'disabled' => true
            ])
            ->add('clientValiditePermis', DateType::class, [
                'label' => 'Date de validité du permis',
                'widget' => 'choice',
                'format' => 'd-M-y',
                'required' => false,
                'years' => range(date('y'), date('y')+48),
                'disabled' => true
                
            ])
        ;
        
        /*
        $builder->get('clientRole')
                ->addModelTransformer(new CallbackTransformer(
                    function ($rolesArray) {
                        // transform the array to a string
                        //return count($rolesArray)? $rolesArray[0]: null;
                        return implode(', ', $rolesArray);
                    },
                    function ($rolesString) {
                        // transform the string back to an array
                        //return [$rolesString];
                        return explode(', ', $rolesString);
                    }
    ));
    */
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
