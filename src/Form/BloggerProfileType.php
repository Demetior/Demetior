<?php

namespace App\Form;

use App\Entity\BloggerProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloggerProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('bio')
            ->add('niche')
            ->add('location')
            ->add('reach')
            ->add('collaborationsCount')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BloggerProfile::class,
        ]);
    }
}
