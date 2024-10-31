<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                'class' => '',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'label' => 'Nom du bien',
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 2, 'max' => 50])
            ]
            ])
            ->add('adresse',TextType::class, [
                'attr' => [
                    'class' => '',
                    'minlenght' => '2',
                ],
                'required' => false,
                'label' => 'Adresse du bien',
                'label_attr' => [
                    'class' => ''
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2])
                ]
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3000k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un document d\'image valide',
                    ])
                ],
            ])
            ->add('NbreRadiateur', IntegerType::class, [
                'required' => false,
                'label' => 'Nombre de radiateurs',
            ])
            ->add('Chaudiere', CheckboxType::class, [
                'required' => false,
                'label' => 'Chaudière',
            ])
            ->add('ChauffeEau', CheckboxType::class, [
                'required' => false,
                'label' => 'Chauffe-eau',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => '',
                ],
                
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
