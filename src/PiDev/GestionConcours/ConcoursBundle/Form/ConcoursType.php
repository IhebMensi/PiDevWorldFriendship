<?php

namespace PiDev\GestionConcours\ConcoursBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConcoursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomconcours')
            ->add('datedebut', DateType::class)
            ->add('datefin',DateType::class)
            ->add('descriptionconcours')
            ->add('prixgagnant')
            ->add('categorie', EntityType::class, array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',
                'choice_label'=>'nomcategorie',
                'multiple'=>false ))
            ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionConcours\ConcoursBundle\Entity\Concours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionconcours_concoursbundle_concours';
    }


}
