<?php

namespace App\Form\Game;

use App\Entity\Game\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameStartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'required' => false,
            ])
            ->add('find', ButtonType::class, [
                'attr' => [
                    'data-url' => 'find',
                    'class' => 'btn btn-primary btn-create-game',
                ]
            ])
            ->add('new', ButtonType::class, [
                'attr' => [
                    'data-url' => 'new',
                    'class' => 'btn btn-primary btn-create-game',
                ]
            ])
            ->add('random', ButtonType::class, [
                'attr' => [
                    'data-url' => 'random',
                    'class' => 'btn btn-primary btn-create-game',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'label_format' => 'form.game.%name%'
        ]);
    }
}
