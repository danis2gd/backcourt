<?php
declare(strict_types=1);

namespace App\Form;

use App\Classes\DTO\GetPlayerRequest;
use App\DTO\TeamDTO;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'player',
                EntityType::class,
                [
                    'class' => Player::class
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GetPlayerRequest::class,
            'csrf_protection' => false
        ]);
    }
}
