<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 14/02/2019
 * Time: 19:47
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class rechercheContenuForm extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenupublicte',TextType::class)
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