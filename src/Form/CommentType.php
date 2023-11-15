<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['user'];

        if ($user) {
            $builder
                ->add('idUser', null, [
                    'data' => $user->getIduser(),
                    'mapped' => false, // Exclude this field from being mapped to the entity
                ]);
        }

        $builder
            
            ->add('descriptionComment')
            ->add('Published',SubmitType::class);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'user' => null,
        ]);
    }
}
