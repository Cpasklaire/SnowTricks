<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FormTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            //->add('slug')
            ->add('content')
            //->add('createdAte')
            //->add('upDating')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Facile' => 1,
                    'Moyen' => 2,
                    'Difficile' => 3,
                    'Mortel' => 4,
                ]
            ])
            //->add('media')
            //->add('comments');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
