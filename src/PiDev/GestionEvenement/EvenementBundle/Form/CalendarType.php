<?php

namespace PiDev\GestionEvenement\EvenementBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CalendarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomcal',TextType::class)
            ->add('descriptioncal',TextareaType::class)
            ->add('datecald',DateTimeType::class)
            ->add('datecalf',DateTimeType::class)
            ->add('Valider',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionEvenement\EvenementBundle\Entity\Calendar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionevenement_evenementbundle_calendar';
    }


}
