<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 19/02/2019
 * Time: 12:28
 */

namespace PiDev\GestionEvenement\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextType::class)
            ->add('Valider', SubmitType::class);
        /**
         * {@inheritdoc}
         */
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionEvenement\EvenementBundle\Entity\CommentEvenement'
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