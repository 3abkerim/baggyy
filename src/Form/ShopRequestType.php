<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productUrl', TextType::class, [
                'label' => 'Product URL',
                'mapped' => false,
                'label_attr' => ['mb-1'],
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5',
                    'placeholder' => 'Product URL',
                    'required' => true,
                ],
            ])
            ->add('departure', TextType::class, [
                'label' => 'Choose from which country you want this product',
                'mapped' => false,
                'label_attr' => ['mb-1'],
                'attr' => [
                    'class' => 'country-autocomplete bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5',
                    'placeholder' => 'Choose Country',
                    'id' => 'from-country-city-input',
                    'list' => 'from-suggestions',
                    'required' => true,
                ],
            ])
            ->add('destination', TextType::class, [
                'label' => 'Destination',
                'mapped' => false,
                'label_attr' => ['mb-1'],
                'attr' => [
                    'class' => 'city-autocomplete bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5',
                    'placeholder' => 'Choose City',
                    'id' => 'to-country-city-input',
                    'list' => 'to-suggestions',
                    'required' => true,
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Add Trip',
                'attr' => [
                    'class' => 'border-2 border-black text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 hover:cursor-pointer',
                ],
                'row_attr' => [
                    'class' => 'flex justify-center mt-4',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
