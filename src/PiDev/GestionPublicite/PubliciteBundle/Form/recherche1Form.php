<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 15/02/2019
 * Time: 18:23
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class recherche1Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        return 'PiDev_GestionPublicite_PubliciteBundle_publicite_form' ;
    }
}