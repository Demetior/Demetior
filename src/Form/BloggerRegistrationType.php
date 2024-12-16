<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Form\BloggerType;
use App\Form\UserType;
use App\Form\BlogType;

class BloggerRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, [
                'label' => false
            ])
            ->add('blogger', BloggerType::class, [
                'label' => false
            ])
            ->add('blog', BlogType::class, [
                'label' => false
            ])

            // ->add('email', EmailType::class)
            // ->add('password', PasswordType::class)
            // ->add('name', TextType::class)
            // ->add('surname', TextType::class)
            // ->add('birthDate', TextType::class) // You may want to use a DateType for better handling
            // ->add('bio', TextType::class)
            // ->add('location', TextType::class, [
            //     'required' => false,
            // ])
            // ->add('platforms', TextType::class, [
            //     'required' => false,
            // ])
            // ->add('blogName', TextType::class) // Blog fields
            // ->add('niche', TextType::class)
            // ->add('website', TextType::class);
    
            // ->add('reach', TextType::class);
           ->get('blogger')
                ->remove('bio')
                ->remove('location')
                ->remove('platforms')
                ;

           $builder ->get('blog')
                ->remove('reach')
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
             'validation_groups' => 'register'
        ]);
    }
}
