<?php

namespace App\Form;

use App\Entity\Blogger;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class BloggerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
                'label' => 'user.form.register.first_name.label'
        ])
        ->add('surname', TextType::class, [
            'label' => 'user.form.register.last_name.label'
        ])
        ->add('birthDate', BirthdayType::class, [
            'label' => 'user.form.register.birthday.label',
            'placeholder' => [
                'year' => 'core.year',
                'month' => 'core.month',
                'day' => 'core.day'
            ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blogger::class,
        ]);
    }
}

