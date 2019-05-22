<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 22/02/2019
 * Time: 19:23
 */

namespace PiDev\GestionVente\VenteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RangePrixType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomproduit',RangeType::class,array(
            'attr'=> array(
        'min' => 0,
        'moy'> 2500,
        'max' => 5000,
    )))
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