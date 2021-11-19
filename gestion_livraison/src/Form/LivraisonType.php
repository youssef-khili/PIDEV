<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('depart',textType::class ,[
                    'label'=>'Depart:',
                    'attr'=>[
                        'placeholder'=>'Votre depart',
                        'class'=>'depart'



                    ]
                ]
            )
            ->add('arrive',textType::class ,[
                    'label'=>'Arrivé:',
                    'attr'=>[
                        'placeholder'=>'Votre arrivé',
                        'class'=>'arrive'



                    ]
                ]
            )
            ->add('type_objet',textType::class ,[
                    'label'=>'Type de l objet:',
                    'attr'=>[

                        'class'=>'type_objet'



                    ]
                ]
            )
            ->add('emplacement_et_etat',textType::class ,[
                    'label'=>'Emplacement et état:',
                    'attr'=>[

                        'class'=>'emplacement_et_etat'



                    ]
                ]
            )
            ->add('poids_unitaire',textType::class ,[
                    'label'=>'Poids unitaire:',
                    'attr'=>[
                        'class'=>'poids_unitaire'



                    ]
                ]
            )
            ->add('tarif',textType::class ,[
                    'label'=>'Tarif:',
                    'attr'=>[
                        'class'=>'tarif'



                    ]
                ]
            )
            ->add('save' , submitType::class,
                ['label'=>'Ajouter'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
