<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Email address', EmailType::class, [
                'label' => 'Email',
                'attr' => [],
                'required' => true,
                'trim' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => true,
                'attr' => [],
            ])
            ->add('remember_me', CheckboxType::class, [])
            ->add('submit', SubmitType::class, [
                'label' => 'Login',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
