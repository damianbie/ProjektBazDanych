<?php

namespace App\Form;

use App\Entity\Worker;
use App\Form\DataTransformer\DateToStringTransformer;
use App\FormTypes\DatePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Types\DataPickerType;

class AddEditWorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('birthDate', DatePickerType::class)
            ->add('phoneNumber', TextType::class)
            ->add('hiredAt', DatePickerType::class)
            ->add('bonus', NumberType::class)
            ->add('submit', SubmitType::class, ['label' => 'Zapisz zmiany'])
            //->add('workPlace')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Worker::class,
        ]);
    }
}