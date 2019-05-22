<?php

namespace PiDev\GestionCategorie\CategorieBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InteretType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userid',EntityType::class, array(
            'class'=>'PiDevGestionUserFosBundle:User',
            'choice_label'=>'username',
            'disabled'=>true))
            ->add('categorie',EntityType::class, array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',
                'choice_label'=>'nomcategorie',
                'disabled'=>true))
            ->add('Valider',SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionCategorie\CategorieBundle\Entity\Interet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestioncategorie_categoriebundle_interet';
    }


}
