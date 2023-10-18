<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('ref', TextType::class, [
            'label' => 'Reference',
        ])
        ->add('title', TextType::class, [
            'label' => 'Title',
        ])
        ->add('category', TextType::class, [
            'label' => 'Category',
        ])
        ->add('publicationDate', DateType::class, [
            'label' => 'Publication Date',
        ])
        ->add('published', CheckboxType::class, [
            'label' => 'Published',
            'required' => false, // If the published field is not required
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Save', // Button label
        ]);
}

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Book::class,
    ]);
}

}
    

