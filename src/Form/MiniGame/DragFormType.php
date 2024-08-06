<?php

namespace App\Form\MiniGame;

use App\Entity\MiniGames\Drag\MiniGameDragItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DragFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstPart', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'help' => 'Příklad: "2"'
            ])
            ->add('partBetween', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'help' => 'Příklad: "+"'
            ])
            ->add('secondPart', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'help' => 'Příklad: "2"'
            ])
            ->add('answer', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'help' => 'Příklad: "4"'
            ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'Uložit'
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MiniGameDragItem::class,
            'label_format' => 'form.drag.%name%'
        ]);
    }
}
