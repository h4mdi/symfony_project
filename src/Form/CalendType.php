<?php

namespace App\Form;

use App\Entity\Calend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('debut',DateTimeType::class,['date_widget'=>'single_text'])
            ->add('fin',DateTimeType::class,['date_widget'=>'single_text'])
            ->add('description')
            ->add('dall_days')
            ->add('bg_color',ColorType::class)
            ->add('text_color',ColorType::class)
            ->add('border_color',ColorType::class)
            ->add('id_cours')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calend::class,
        ]);
    }
}
