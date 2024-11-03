<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Contracts\Translation\TranslatorInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PageType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $page = $options['data'];

        $builder
            ->add('code', TextType::class, [
                'label' => $this->translator->trans('name', [], 'page'),
                'data' => $this->translator->trans($page->getCode(), [], 'page'),
                'disabled' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('content_fr', TextareaType::class, [
                'label' => $this->translator->trans('content_fr', [], 'page'),
                'required' => true,
                'empty_data' => '',
                'attr' => ['class' => 'form-control', 'rows' => 5, 'cols' => 40],
            ])
            ->add('content_en', TextareaType::class, [
                'label' => $this->translator->trans('content_en', [], 'page'),
                'required' => true,
                'empty_data' => '',
                'attr' => ['class' => 'form-control', 'rows' => 5, 'cols' => 40],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
