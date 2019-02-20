<?php

namespace PiDev\GestionPublicite\PubliciteBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nompublicite',TextType::class)
            ->add('contenupublicte',TextType::class)
            ->add('file',FileType::class)
            ->add('lien',UrlType::class)
            ->add('datepublicite',DateType::class)
            ->add('datepublicitefin',DateType::class)
          #->add('sponsorid')
            ->add('categorie',EntityType::class,array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',
                'choice_label'=>'nomcategorie'

            ))
            ->add('pays',TextType::class)
            ->add('region',TextType::class)
            ->add('adresse',TextType::class)

            ->add('point',NumberType::class)
            ->add('pourcentage',PercentType::class)
            ->add('prixremise',NumberType::class)
            ->add('prixproduit',NumberType::class)
            ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionPublicite\PubliciteBundle\Entity\Pub'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionpublicite_publicitebundle_pub';
    }


}
