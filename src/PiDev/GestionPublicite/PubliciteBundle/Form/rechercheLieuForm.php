<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 19/02/2019
 * Time: 11:05
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class rechercheLieuForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pays',TextType::class,['required'=>false])
            ->add('region',TextType::class,['required'=>false])

            ->add('categorie',EntityType::class,array(
                'class'=>'PiDevGestionCategorieCategorieBundle:Categorie',

                'choice_label'=>'nomcategorie'))
            ->add('Valider',SubmitType::class);
    }



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName(){
        return 'PiDev_GestionPublicite_PubliciteBundle_lieu_form' ;
    }
}