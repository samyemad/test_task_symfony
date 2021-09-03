<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Blog\Article;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\CommentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('description',TextareaType::class)
            ->add('linkImage',UrlType::class)
            ->add('comments', CollectionType::class, [
                'entry_type' => CommentType::class,
                'allow_add' => true,
                'delete_empty' => false,
                'allow_delete' => false,
                'by_reference' => false,
                'prototype' => 'comments'
            ])

            ->add('save', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Article::class,
            'validation_groups' => ['create']
        ));
    }
}