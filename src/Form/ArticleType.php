<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre:',
                'required' => true,
                'attr' => [
                    'placeholder' => "Titre de votre article"
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu:',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Contenu de votre article',
                    'rows' => 5,
                ]
            ])
            ->add('enable', CheckboxType::class, [
                'label' => 'Actif',
                'required' => false,
            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories:',
                'required' => false,
                'class' => Categorie::class,
                'choice_label' => 'title',
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.enable = :enable')
                        ->setParameter('enable', true)
                        ->orderBy('c.title', 'ASC');
                },
                'expanded' => false,
                'multiple' => true,
                'autocomplete' => true,
                'by_reference' => false,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image:',
                'required' => false,
                'allow_delete' => false,
                'delete_label' => 'Supprimer l\'image',
                'image_uri' => true,
                'download_uri' => false,
            ]);
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
