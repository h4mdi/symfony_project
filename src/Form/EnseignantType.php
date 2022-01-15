<?php

namespace App\Form;

use App\Entity\Enseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('datenaiss',DateType::class, array(
        'widget' => 'choice',
        'years' => range(date('Y'), date('Y')-100),
        'months' => range(date('m'), 12),
        'days' => range(1, 31),
                'format' => 'dd-MMM-yyyy',

    ))
            ->add('cin')
            ->add('grade')
            ->add('specialite')
            ->add('tel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
