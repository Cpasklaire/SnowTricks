<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FormMediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', TextType::class, ['required' => false,])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Photo' => 1,
                    'Video' => 2,
                ]
            ])
            //->add('createdAte')
            //->add('upDating')
            //->add('trickRelation')
            ->add('imageFile', VichImageType::class, ['required' => false,])
            ->add('mainPhoto', CheckboxType::class, [
                'label' => 'Est-ce l\'image principale ?',
                'required' => false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
