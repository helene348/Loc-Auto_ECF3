<?php

namespace App\Form;

use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('agenceAdresse', TextareaType::class, [
                'label' => 'Adresse de l\'agence',
                'help' => 'L\'adresse doit faire au minimum 15 caractères'
            ])
            ->add('agenceTelephone', TelType::class, [
                'label' => 'Numéro de téléphone de l\'agence',
                'help' => 'Les symboles acceptés sont les tirets, espaces, point et le "+"'
            ])
            ->add('agenceMail', EmailType::class, [
                'label' => 'Adresse mail de l\'agence',
                'help' => 'Merci de respecter le modèle suivant:
                 ville@locauto.fr. Exemple: nancy@locauto.fr'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
