<?php

namespace App\Form;

use App\Entity\Puppy;
use App\Entity\Litter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PuppyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Chiot : '
            ])
            ->add('breed', ChoiceType::class, [
                'label' => 'Race : ',
                'choices' => [
                    'Cane Corso' => 'Cane Corso',
                    'Teckel' => 'Teckel',
                    'Whippet' => 'Whippet',
                ]
            ])
            ->add('breeder', ChoiceType::class, [
                'label' => 'Elevage : ',
                'choices' => [
                    'Le Domaine des Terres Noires' => 'du Domaine des Terres Noires',
                    'Le Temple de Jade' => 'du Temple de Jade',
                    'Corso Di Munteanu' => 'di Corso di Munteanu',
                    'La Romance des Damoiseaux' => 'de la Romance des Damoiseaux',
                ]
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Mâle' => 'Mâle',
                    'Femelle' => 'Femelle',
                ],
                'label' => 'Sexe : ',
            ])
            ->add('litter', EntityType::class, [
                'class' => Litter::class,
                'label' => 'Portée : ',
                'choice_label' => function ($litter)
                {
                    $birth = $litter->getBirth();
                    $mom = $litter->getMom();
                    return $mom.' - '.date_format($birth, 'd/m/Y');
                },
                //'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Puppy::class,
            'litters' => [],
            'mom' => [],
        ]);
    }
}
