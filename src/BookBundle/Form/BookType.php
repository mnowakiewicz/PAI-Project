<?php

namespace BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('googleId')
            ->add('etag')
            ->add('title')
            ->add('subtitle')
            ->add('publishedDate')
            ->add('description')
            ->add('pageCount')
            ->add('language')
            ->add('webReaderLink')
            ->add('isActive')
            ->add('creationDate')
            ->add('editDate')
            ->add('authors')
            ->add('printType')
            ->add('categories')
            ->add('publisher')
            ->add('image')
            ->add('creator')
            ->add('lastEditor');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BookBundle\Entity\Book'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bookbundle_book';
    }


}
