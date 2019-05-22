<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 21/02/2019
 * Time: 15:59
 */

namespace PiDev\GestionEvenement\EvenementBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheEventLieuForm extends AbstractType
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
        return 'PiDev_GestionReclamation_ReclamationBundle_lieu_form' ;
    }
}