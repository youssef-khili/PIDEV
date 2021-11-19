<?php

namespace App\Form;

use App\Entity\Livreur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',textType::class ,[
                'label'=>'Nom:',
                'attr'=>[
                    'placeholder'=>'Votre nom',
                    'class'=>'nom'



                ]
            ]
            )
            ->add('prenom',textType::class ,[
                'label'=>'Prénom:',
                'attr'=>[
                    'placeholder'=>'Votre prénom',
                    'class'=>'prenom'



                ]
            ])
            ->add('num_tel',textType::class ,[
                'label'=>'N° tel:',
                'attr'=>[
                    'class'=>'num_tel'



                ]
            ])
            ->add('cin',textType::class ,[
                'label'=>'N° CIN:',
                'attr'=>[
                    'class'=>'cin'



                ]
            ])
            ->add('rate',textType::class ,[
                'label'=>'Rate:',
                'attr'=>[
                    'class'=>'rate'



                ]
            ])
            ->add('save' , submitType::class,
                ['label'=>'Ajouter'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livreur::class,
        ]);
    }
}
