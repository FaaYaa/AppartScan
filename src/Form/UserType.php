<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('fullName', TextType::class, [
            'required' => false,
            'attr' => [
                'class' => '',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'label' => 'Nom / Prénom',
            'label_attr' => [
                'class' => ''
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50])
            ]
        ])
        ->add('username', TextType::class, [
            'attr' => [
                'class' => '',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'required' => false,
            'label' => 'Pseudo (Facultatif)',
            'label_attr' => [
                'class' => ''
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50])
            ]
        ])
        ->add('plainPassword', PasswordType::class, [
            'attr' => [
                'class' => ''
            ],
            'label' => 'Mot de passe',
            'label_attr' => [
                'class' => ''
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Valider',
            'attr' => [
                'class' => '',
            ],
            
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
