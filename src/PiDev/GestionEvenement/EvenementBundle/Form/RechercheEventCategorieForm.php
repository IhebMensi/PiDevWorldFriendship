<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 21/02/2019
 * Time: 18:15
 */

namespace PiDev\GestionEvenement\EvenementBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheEventCategorieForm extends AbstractType
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
        return 'PiDev_GestionEvenement_EvenementBundle_evenement_form' ;
    }
}