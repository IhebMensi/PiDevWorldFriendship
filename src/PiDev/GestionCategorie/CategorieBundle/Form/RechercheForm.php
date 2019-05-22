<?php
/**
 * Created by PhpStorm.
 * User: dorra
 * Date: 19/02/2019
 * Time: 11:56
 */

namespace PiDev\GestionCategorie\CategorieBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomcategorie')
            ->add('Rechercher',SubmitType::class);
    }

}