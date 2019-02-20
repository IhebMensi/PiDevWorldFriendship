<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 18/02/2019
 * Time: 19:23
 */

namespace PiDev\GestionEvenement\EvenementBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheEventForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomevenement', TextType::class)
            ->add('Valider', SubmitType::class);
        /**
         * {@inheritdoc}
         */
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionEvenement\EvenementBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionevenement_evenementbundle_evenement';
    }

}