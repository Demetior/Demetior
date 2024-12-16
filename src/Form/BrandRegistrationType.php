<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Form\BrandType;
use App\Form\UserType;

class BrandRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, [
                'label' => false
            ])
            ->add('brand', BrandType::class, [
                'label' => false
            ])

            ->get('brand')
                ->remove('description')
                ->remove('location')
                ->remove('previousCampaigns')
            ;

}

public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
             'validation_groups' => 'register'
        ]);
    }
}
