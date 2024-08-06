<?php

namespace App\Form\MiniGame;

use App\Entity\MiniGames\Match\MiniGameMatchAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $builder->getData();
        $builder
            ->add('questionText', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'help' => 'Příklad: "2 + 2"',
                'mapped' => false,
                'data' => $data->getQuestion()?->getQuestion()
            ])
            ->add('answer', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'Uložit'
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MiniGameMatchAnswer::class,
            'label_format' => 'form.match.%name%'
        ]);
    }
}
