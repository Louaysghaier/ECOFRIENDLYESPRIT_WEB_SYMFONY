<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('servicename', null, [

                'constraints' => [
                    new NotBlank(['message' => 'check the chatbot for help!','allowNull' => true,
                    ]),

                ],
            ])
            ->add('price', null, [

                'constraints' => [
                    new NotBlank(['message' => 'check the chatbot for help!']),
                    new Type(['type' => 'numeric', 'message' => 'Price must be a valid number.']),
                ],
            ])
            ->add('img', FileType::class, [
                'label' => 'Upload Image',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'maxSizeMessage' => 'The file is too large. Maximum allowed size is 5MB.',
                        'mimeTypes' => ['image/*'],
                        'mimeTypesMessage' => 'Please upload a valid image file.',
                    ]),
                ],
            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
