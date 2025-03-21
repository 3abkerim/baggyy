<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Travel;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('departure', TextType::class, [
                'label' => 'Departure',
                'mapped' => false,
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                    'placeholder' => 'Choose City or Country',
                    'id' => 'from-country-city-input',
                    'list' => 'from-suggestions',
                    'required' => true,
                ]
            ])
            ->add('destination', TextType::class, [
                'label' => 'Destination',
                'mapped' => false,
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                    'placeholder' => 'Choose City or Country',
                    'id' => 'to-country-city-input',
                    'list' => 'to-suggestions',
                    'required' => true,
                ]
            ])
            ->add('tripDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Departure Date',
                'attr' => [
                    'required' => true,
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ]
            ])
            ->add('returnTrip', CheckboxType::class, [
                'label' => 'Add return date',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'id' => 'checkbox-return-trip',
                ],
                'row_attr' => [
                    'class' => 'flex items-center gap-2'
                ]
            ])
            ->add('returnDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Return Date',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'id' => 'return-date',
                    'class' => 'invisible h-0 js-return-date-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add Trip',
                'attr' => [
                    'class'=> 'border-2 border-black text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 hover:cursor-pointer',
                ],
                'row_attr' => [
                    'class' => 'flex justify-center mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Travel::class,
        ]);
    }
}
