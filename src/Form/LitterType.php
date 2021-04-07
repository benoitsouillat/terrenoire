<?php

namespace App\Form;

use App\Entity\Dog;
use App\Form\DogType;
use App\Entity\Litter;
use App\Repository\DogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

class LitterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $values = [];
        for($i = 0; $i < sizeof($options['dogs']); $i++)
        {
            $values[$options['dogs'][$i]] = $options['dogs'][$i];
        }

        $builder
            ->add('mom', ChoiceType::class, [
                'choices' => $values,
            ])
            ->add('dad', ChoiceType::class, [
                'choices' => $values,
            ])
            ->add('nbFemale', IntegerType::class)
            ->add('nbMale', IntegerType::class)
            ->add('birth', DateType::class)
            ->add('dog', EntityType::class, [
                'class' => Dog::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Litter::class,
            'id' => [],
            'name' => [],
            'dogs' => [],
        ]);
    }
}
