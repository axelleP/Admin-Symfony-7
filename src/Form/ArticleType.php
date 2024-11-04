<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'required' => true,
                'class' => Category::class,
                'choice_label' => 'name_fr',
                'attr' => ['class' => 'form-control']
            ])
            ->add('title_fr', TextType::class, [
                'label' => $this->translator->trans('title_fr', [], 'article'),
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('title_en', TextType::class, [
                'label' => $this->translator->trans('title_en', [], 'article'),
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('image', FileType::class, [
                'required' => (!$builder->getData()->getId()) ? true : false,
                'label' => $this->translator->trans('image', [], 'article'),
                'constraints' => [
                    new Assert\Image([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => $this->translator->trans('article.image.format', [], 'validation'),
                    ]),
                ],
                'empty_data' => '',
                'mapped' => false
            ])
            ->add('content_fr', TextareaType::class, [
                'required' => true,
                'label' => $this->translator->trans('content_fr', [], 'article'),
                'empty_data' => '',
                'attr' => ['class' => 'form-control', 'rows' => 5, 'cols' => 40],
            ])
            ->add('content_en', TextareaType::class, [
                'required' => true,
                'label' => $this->translator->trans('content_en', [], 'article'),
                'empty_data' => '',
                'attr' => ['class' => 'form-control', 'rows' => 5, 'cols' => 40],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
