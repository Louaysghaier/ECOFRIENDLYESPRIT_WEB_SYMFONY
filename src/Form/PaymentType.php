<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCarte', TextType::class, ['label' => 'Nom sur la carte'])
            ->add('numeroCarte', TextType::class, ['label' => 'Numéro de carte'])
            ->add('dateExpiration', TextType::class, ['label' => 'Date d\'expiration'])
            // Ajoutez d'autres champs de formulaire si nécessaire...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configurez les options du formulaire si nécessaire...
        ]);
    }
}