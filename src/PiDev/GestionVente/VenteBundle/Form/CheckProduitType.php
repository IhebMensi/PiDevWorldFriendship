<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 19/02/2019
 * Time: 11:03
 */

namespace PiDev\GestionVente\VenteBundle\Form;


use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;


class CheckProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('categorie',ChoiceType::class,array('choices' =>
                array('Jeux Vidéo' => 'Jeux Vidéo' ,
                    'Musique' =>  'Musique',
                    'Pc' => 'Pc',
                    'Tel'=>'Tel',
                    'Sport'=>'Sport')))
            ->add('Rechercher_Produit',SubmitType::class)
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


