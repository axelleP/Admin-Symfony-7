<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['context'] == 'update') {
            $builder->add('position', IntegerType::class, [
                'required' => true,
                'empty_data' => '0',
            ]);
        }

        $builder
        ->add('code', TextType::class, [
            'required' => true,
            'empty_data' => ''
        ])
        ->add('name_fr', TextType::class, [
            'required' => true,
            'empty_data' => ''
        ])
        ->add('name_en', TextType::class, [
            'required' => true,
            'empty_data' => ''
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'attr' => ['class' => 'd-flex gap-2 my-2'],
            'context' => ''
        ]);
    }
}
