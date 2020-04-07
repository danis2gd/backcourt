<?php

namespace App\Form;

use App\Classes\DataClass\RegisterDataClass;
use App\DTO\TeamDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Name'
                ]
            )
            ->add(
                'abbreviation',
                TextType::class,
                [
                    'label' => 'Abbreviation',
                    'attr' => [
                        'maxlength' => 3
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 1,
                            'max' => 3
                        ])
                    ]
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Create',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TeamDTO::class,
        ]);
    }
}
