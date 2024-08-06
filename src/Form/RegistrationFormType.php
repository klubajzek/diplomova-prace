<?php

namespace App\Form;

use App\Entity\User\User;
use App\Model\Roles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ])
            ->add('name', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ])
            ->add('surname', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ])
            ->add('email', EmailType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ]);

        if (!$options['isEdit']) {
            $builder->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Heslo nesmí být prázdné!',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Minimum znaků pro heslo je 6!',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ]);
        }

        if (!$options['isInAdmin'] && !$options['isProfile']) {
            $builder->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Musíte souhlasit s podmínkami!',
                    ]),
                ],
                'row_attr' => [
                    'class' => 'form-group flex-row'
                ],
            ]);
        } elseif (!$options['isProfile']){
            $builder->add('roles', ChoiceType::class, [
                'choices' => [
                    Roles::array()
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'row_attr' => [
                    'class' => 'form-group'
                ],
            ]);
        }

        $builder->add('submit', SubmitType::class, [
            'label' => 'Uložit'
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'label_format' => 'form.registration.%name%',
            'isInAdmin' => false,
            'isEdit' => false,
            'isProfile' => false
        ]);
    }
}
