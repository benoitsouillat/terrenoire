<?php

namespace App\Form;

use App\Entity\Dog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
            ] )
            ->add('breed', ChoiceType::class, [
                'choices' => [
                    'Cane Corso' => 'Cane Corso',
                    'Teckel' => 'Teckel',
                ]
            ])
            ->add('breeder', ChoiceType::class, [
                'choices' => [
                    'Le Domaine des Terres Noires' => 'du Domaine des Terres Noires',
                    'Le Temple de Jade' => 'du Temple de Jade',
                    'Corso Di Munteanu' => 'di Corso di Munteanu',
                ]
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Mâle' => 'Mâle',
                    'Femelle' => 'Femelle',
                ]
            ])
            ->add('lof', TextType::class)
            ->add('microship', TextType::class)
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'Noir' => 'Noir',
                    'Fauve' => 'Fauve',
                    'Gris' => ' Gris',
                    'Froment' => 'Froment',
                    'Bringé Noir' => 'Bringé Noir',
                    'Bringé Gris' => 'Bringé Gris',
                ]
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
