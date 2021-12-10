<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomUser')
            ->add('prenomUser')
            ->add('email')
            ->add('numTel')
            ->add('username')
            ->add('password')
            ->add('depart')
            ->add('destination')
            ->add('cout')
            ->add('typeService')
            ->add('role')
            ->add("captchaCode",CaptchaType::class,[
            'captchaConfig' => 'ExampleCaptchaUserRegistration',
            'constraints' => [
                new ValidCaptcha([
                    'message' => 'Invalid captcha,please try again',
                ]),

            ],
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }


}
