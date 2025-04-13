<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopLinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productUrl', UrlType::class, [
                'label' => 'Product URL',
                'required' => true,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'https://example.com/product'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Next',
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
