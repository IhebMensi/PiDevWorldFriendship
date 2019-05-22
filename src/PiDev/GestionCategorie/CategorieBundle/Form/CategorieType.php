<?php

namespace PiDev\GestionCategorie\CategorieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomcategorie')
            ->add('imagecategorie',FileType::class, array('data_class' => null) )
            ->add('descriptioncategorie')
            ->add('Valider',SubmitType::class);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionCategorie\CategorieBundle\Entity\Categorie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestioncategorie_categoriebundle_categorie';
    }


}
