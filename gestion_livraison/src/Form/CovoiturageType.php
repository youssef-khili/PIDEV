<?php

namespace App\Form;

use App\Entity\Covoiturage;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\TypeResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CovoiturageType extends AbstractType
{  public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('depart', textType::class, ['label'=>'adresse depart ',
            'attr'=>[

                'class'=>'depart'

                ,'placeholder'=>'merci de definir le depart ',

            ] ] )


        ->add('arrive',textType::class, ['label'=>'adresse arrive ',
            'attr'=>[

                'class'=>'arrive'

                ,'placeholder'=>'merci de definir l arrive ',

            ] ] )


        ->add('tarif', IntegerType::class
        )
        ->add ('longueurtrajet',IntegerType::class)
        ->add('idveh',IntegerType::class )
        ->add('nbpsg',IntegerType::class)
        ->add('save' , submitType::class,
            ['label'=>'valider'])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Covoiturage::class,
        ]);
    }
}
