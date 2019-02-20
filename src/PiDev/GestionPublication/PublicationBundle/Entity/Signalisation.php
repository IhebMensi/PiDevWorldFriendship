<?php

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Signalisation
 *
 * @ORM\Table(name="signalisation")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublication\PublicationBundle\Repository\SignalisationRepository")
 */
class Signalisation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrsignalisation", type="integer")
     */
    private $nbrsignalisation;
    /**
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $idPublication;

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
     * Set etat
     *
     * @param string $etat
     *
     * @return Signalisation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set nbrsignalisation
     *
     * @param integer $nbrsignalisation
     *
     * @return Signalisation
     */
    public function setNbrsignalisation($nbrsignalisation)
    {
        $this->nbrsignalisation = $nbrsignalisation;

        return $this;
    }

    /**
     * Get nbrsignalisation
     *
     * @return int
     */
    public function getNbrsignalisation()
    {
        return $this->nbrsignalisation;
    }

    /**
     * @return mixed
     */
    public function getIdPublication()
    {
        return $this->idPublication;
    }

    /**
     * @param mixed $idPublication
     */
    public function setIdPublication($idPublication)
    {
        $this->idPublication = $idPublication;
    }

}

