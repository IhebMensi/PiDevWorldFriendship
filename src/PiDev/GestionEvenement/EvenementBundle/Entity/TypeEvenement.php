<?php

namespace PiDev\GestionEvenement\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use SBC\NotificationsBundle\Model\NotifiableInterface;

/**
 * TypeEvenement
 *
 * @ORM\Table(name="type_evenement")
 * @ORM\Entity(repositoryClass="PiDev\GestionEvenement\EvenementBundle\Repository\TypeEvenementRepository")
 */
class TypeEvenement implements NotifiableInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtype", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtype;

    /**
     * @var string
     *
     * @ORM\Column(name="nomtype", type="string", length=255)
     */
    private $nomtype;

    /**
     * @return int
     */
    public function getIdtype()
    {
        return $this->idtype;
    }

    /**
     * @param int $idtype
     */
    public function setIdtype($idtype)
    {
        $this->idtype = $idtype;
    }


    /**
     * Get id
     *
     * @return int
     */



    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomtype
     *
     * @param string $nomtype
     *
     * @return TypeEvenement
     */
    public function setNomtype($nomtype)
    {
        $this->nomtype = $nomtype;

        return $this;
    }

    /**
     * Get nomtype
     *
     * @return string
     */
    public function getNomtype()
    {
        return $this->nomtype;
    }

    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('New blog')
            ->setDescription($this->getNomtype())
            ->setRoute('pi_dev_gestion_evenement_AfficherType')
            ->setParameters(array('id' => $this->getIdtype()))
        ;
        $builder->addNotification($notification);
        return $builder;
    }

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('up blog')
            ->setDescription($this->getNomtype())
            ->setRoute('pi_dev_gestion_evenement_AfficherType')
            ->setParameters(array('id' => $this->getIdtype()))
        ;
        $builder->addNotification($notification);
        return $builder;
    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
       return $builder;
    }


}

