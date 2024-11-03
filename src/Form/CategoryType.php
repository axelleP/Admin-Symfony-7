<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Contracts\Translation\TranslatorInterface;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['context'] == 'update') {
            $builder->add('position', IntegerType::class, [
                'required' => true,
                'empty_data' => '0',
                'attr' => ['class' => 'form-control', 'placeholder' => $this->translator->trans('position', [], 'category')],
            ]);
        }

        $builder
        ->add('code', TextType::class, [
            'required' => true,
            'empty_data' => '',
            'attr' => ['class' => 'form-control', 'placeholder' => $this->translator->trans('code', [], 'category')],
        ])
        ->add('name_fr', TextType::class, [
            'required' => true,
            'empty_data' => '',
            'attr' => ['class' => 'form-control', 'placeholder' => $this->translator->trans('name_fr', [], 'category')],
        ])
        ->add('name_en', TextType::class, [
            'required' => true,
            'empty_data' => '',
            'attr' => ['class' => 'form-control', 'placeholder' => $this->translator->trans('name_en', [], 'category')],
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
