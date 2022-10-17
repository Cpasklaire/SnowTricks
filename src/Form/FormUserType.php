<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class FormUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Pseudo')
            //->add('roles')
            ->add('password', PasswordType::class, [
                'attr' => ['type' => 'password'],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'attr' => ['type' => 'password'],
            ])
            ->add('email')
            //->add('createdAte')
            ->add('imageFile', VichImageType::class, ['required' => false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
