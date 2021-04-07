<?php

namespace App\Form;

use App\Entity\Puppy;
use App\Entity\Litter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PuppyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('birth')
            ->add('breed')
            ->add('breeder')
            ->add('sex')
            ->add('image')
            ->add('litter', EntityType::class, [
                'class' => Litter::class,
                'choices' => 'mom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Puppy::class,
        ]);
    }
}
