<?php

namespace App\Form;

use App\Entity\Dog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('birth', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
            ] )
            ->add('breed', ChoiceType::class, [
                'choices' => [
                    'Cane Corso' => 'Cane Corso',
                    'Teckel' => 'Teckel',
                    'Whippet' => 'Whippet',
                ]
            ])
            ->add('breeder', ChoiceType::class, [
                'choices' => [
                    'Le Temple de Jade' => 'du Temple de Jade',
                    'Le Domaine des Terres Noires' => 'du Domaine des Terres Noires',
                    'La Romance des Damoiseaux' => 'de la Romance des Damoiseaux',
                    'Corso Di Munteanu' => 'di Corso di Munteanu'
                ]
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Mâle' => 'Mâle',
                    'Femelle' => 'Femelle',
                ]
            ])
            ->add('lof')
            ->add('puce')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}
