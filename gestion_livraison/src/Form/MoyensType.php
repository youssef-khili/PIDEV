<?php

namespace App\Form;

use App\Entity\Moyens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoyensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',TextType::class,[
                'label'=>'type Moyens',
                'attr'=>[
                    'placeholder'=>'merci de définir le type',
                    'class'=>'type'
                ]
            ])
            ->add('depart',TextType::class,[
                'label'=>'depart Moyens',
                'attr'=>[
                    'placeholder'=>'merci de définir le point de depart',
                    'class'=>'depart'
                ]
            ])
            ->add('arrive',TextType::class,[
                'label'=>'arrive Moyens',
                'attr'=>[
                    'placeholder'=>'merci de définir l arrive',
                    'class'=>'arrive'
                ]
            ])
            ->add('tarif',TextType::class,[
                'label'=>'tarif Moyens',
                'attr'=>[
                    'placeholder'=>'merci de définir le tarif',
                    'class'=>'tarif'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Moyens::class,
        ]);
    }
}
