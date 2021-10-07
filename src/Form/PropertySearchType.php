<?php

namespace App\Form;

use App\Entity\SearchProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('min_surface')
            ->add('max_surface')
            ->add('min_price')
            ->add('max_price')
            ->add('min_rooms')
            ->add('max_rooms')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchProperty::class,
        ]);
    }
}
