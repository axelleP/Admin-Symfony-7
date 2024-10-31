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
                'label' => 'Nom',
                'data' => $this->translator->trans($page->getCode(), [], 'page'),
                'disabled' => true,
            ])
            ->add('content_fr', TextareaType::class, [
                'required' => true,
                'label' => 'Contenu FR',
                'attr' => ['rows' => 5, 'cols' => 40],
                'empty_data' => ''
            ])
            ->add('content_en', TextareaType::class, [
                'required' => true,
                'label' => 'Contenu EN',
                'attr' => ['rows' => 5, 'cols' => 40],
                'empty_data' => ''
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
