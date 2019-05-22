<?php

namespace PiDev\GestionConcours\ConcoursBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationConcoursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note',HiddenType::class )
            ->add('userid',EntityType::class, array(
                'class'=>'PiDevGestionUserFosBundle:User',
                'choice_label'=>'username',
                'multiple'=>false,
                'disabled'=>true
                ) )
            ->add('concours',EntityType::class, array(
                'class'=>'PiDevGestionConcoursConcoursBundle:Concours',
                'choice_label'=>'nomconcours',
                'disabled'=>true) )
            ->add('publication',EntityType::class, array(
                'class'=>'PiDevGestionPublicationPublicationBundle:Publication',
                'choice_label'=>'titre',
                'multiple'=>false) )
            ->add('Valider',SubmitType::class);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiDev\GestionConcours\ConcoursBundle\Entity\ParticipationConcours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pidev_gestionconcours_concoursbundle_participationconcours';
    }


}
