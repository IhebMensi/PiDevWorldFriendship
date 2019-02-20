<?php

namespace PiDev\GestionEvenement\EvenementBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomevenement',TextType::class)

            ->add('datedebut', DateType::class)
            ->add('datefin',DateType::class)
            ->add('descriptionevenement',TextType::class)
            ->add('nbrparticipants',TextType::class)
            ->add('payment',ChoiceType::class , array(
                'choices'=>array(
                    'payer' => 'payer',
                    'gratuit' => 'gratuit'
                )
            ))
            ->add('file',FileType::class)
            ->add('nbrplacestotal',TextType::class)
            ->add('nbrtickets',TextType::class)
            ->add('prixtickets',TextType::class)
            # ->add('userid',TextType::class)
            ->add('categorie',EntityType::class,array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',
                'choice_label'=>'nomcategorie'))
            #  ->add('typeevenement',EntityType::class,array(
            # 'class'=>'PiDevGestionEvenementEvenementBundle:TypeEvenement',
            #  'choice_label'=>'idtype'

            #))
            ->add('pays',TextType::class)
            ->add('region',TextType::class)
            ->add('adresse',TextType::class)
            ->add('typeevenement',EntityType::class,array(
                'class'=>'PiDevGestionEvenementEvenementBundle:TypeEvenement',
                'choice_label'=>'nomtype',

            ))
            #  ->add('lieu',EntityType::class,array(
            #'class'=>'PiDevGestionPublicitePubliciteBundle:Lieu',
            #'choice_label'=>'pays'
            # ))
            #  ->add('lieu',EntityType::class,array(
            #   'class'=>'PiDevGestionPublicitePubliciteBundle:Lieu',
            #  'choice_label'=>'region'
            # ))

            ->add('Valider',SubmitType::class);

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionEvenement\EvenementBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionevenement_evenementbundle_evenement';
    }


}
