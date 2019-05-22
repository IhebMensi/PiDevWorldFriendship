<?php

namespace PiDev\GestionPublication\PublicationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contenue',TextareaType::class)
            ->add('file',FileType::class)

            ->add('titre',TextType::class)

            ->add('visibilite',ChoiceType::class,array(
                'choices'=>array(
                    'Private' => 0,
                    'Public' => 1
                )
            ))


            ->add('categorie',EntityType::class,array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',
                'choice_label'=>'nomcategorie'))
            ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionPublication\PublicationBundle\Entity\Publication'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Pidev_gestionpublication_publicationbundle_publication';
    }


}
