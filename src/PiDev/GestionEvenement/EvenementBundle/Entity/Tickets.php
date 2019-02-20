<?php

namespace PiDev\GestionEvenement\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tickets
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="PiDev\GestionEvenement\EvenementBundle\Repository\TicketsRepository")
 */
class Tickets
{
    /**
     * @var int
     *
     * @ORM\Column(name="idticket", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idticket;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="numplace", type="integer")
     */
    private $numplace;
    /**
     * @ORM\ManyToOne(targetEntity="evenement")
     * @ORM\JoinColumn(referencedColumnName="idevenement")
     */
    private $evenement;


    /**
     * @return int
     */
    public function getIdticket()
    {
        return $this->idticket;
    }

    /**
     * @param int $idticket
     */
    public function setIdticket($idticket)
    {
        $this->idticket = $idticket;
    }


    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Tickets
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set numplace
     *
     * @param integer $numplace
     *
     * @return Tickets
     */
    public function setNumplace($numplace)
    {
        $this->numplace = $numplace;

        return $this;
    }

    /**
     * Get numplace
     *
     * @return int
     */
    public function getNumplace()
    {
        return $this->numplace;
    }

    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
    }

}

