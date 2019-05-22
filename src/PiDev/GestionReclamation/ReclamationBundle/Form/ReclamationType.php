<?php

namespace PiDev\GestionReclamation\ReclamationBundle\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descriptionreclam',CKEditorType::class)
            ->add('titrereclam',TextType::class)
           # ->add('etatreclam',TextType::class)
           ->add('datereclam',DateType::class)
            #->add('userid')
            ->add('categorie',EntityType::class,array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',
                'choice_label'=>'nomcategorie'

            ))
            ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionReclamation\ReclamationBundle\Entity\Reclamation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionreclamation_reclamationbundle_reclamation';
    }


}
