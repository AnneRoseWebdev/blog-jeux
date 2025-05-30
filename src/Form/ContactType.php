<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('nom', TextType::class, [
            'label' => 'Votre nom',
            'required' => true,
        ])
        ->add('email', EmailType::class, [
            'label' => 'Votre email',
            'required' => true,
        ])
        ->add('contenu', TextareaType::class, [
            'label' => 'Votre message',
            'required' => true,
        ])
        ->add('envoyer', SubmitType::class, [
            'label' => 'Envoyer',
            'attr' => ['class' => 'btn btn-primary mt-3'],
        ]);
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
