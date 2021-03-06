<?php

namespace App\Form;

use App\Classes\DataClass\RegisterDataClass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Username/Email',
                    'attr' => [
                        'data-parsley-length' => '[3, 100]',
                        'placeholder' => 'Username/Email'
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 4,
                            'max' => 100
                        ])
                    ]
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'label' => 'Password',
                    'attr' => [
                        'placeholder' => 'Password'
                    ]
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Login',
                ]
            )
        ;
    }
}
