<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostType extends AbstractType
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
            ->add('subject')
            ->add('title')
            ->add('descriptionPost')
            ->add('imagePost')
            ->add('nbresComments')
            ->add('Published',SubmitType::class);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'user' => null,
        ]);
    }
}
