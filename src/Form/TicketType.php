<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Assurez-vous d'importer correctement EntityType


class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix')
            ->add('lieuDepart')
            ->add('lieuArrive')
            ->add('dateTicket')
            ->add('statutTicket')
            ->add('idTransport', EntityType::class, [
                'class' => 'App\Entity\Transport', // Assurez-vous que le chemin est correct
                'choice_label' => 'typeTransport', // Utilisez le typeTransport comme libellé du choix
                'label' => 'Type of Transport', // Personnalisez l'étiquette du champ
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
