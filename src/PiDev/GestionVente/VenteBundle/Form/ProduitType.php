<?php

namespace PiDev\GestionVente\VenteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomproduit',TextType::class)
            ->add('datemisevente',DateType::class)
            ->add('categorie',ChoiceType::class,array('choices' =>
            array('Jeux Vidéo' => 'Jeux Vidéo' ,
                'Musique' =>  'Musique',
                'Pc' => 'Pc',
                'Tel'=>'Tel')))
            ->add('pays',TextType::class)
->add('file',FileType::class)
            ->add('prix')
            ->add('descriptionproduit',TextType::class)
            ->add('Ajouter_Produit',SubmitType::class)
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionVente\VenteBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionvente_ventebundle_produit';
    }


}
