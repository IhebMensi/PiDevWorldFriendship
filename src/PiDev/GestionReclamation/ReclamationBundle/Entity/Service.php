<?php

namespace PiDev\GestionReclamation\ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="PiDev\GestionReclamation\ReclamationBundle\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="idservice", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idservice;

    /**
     * @var string
     *
     * @ORM\Column(name="nomservice", type="string", length=255)
     */
    private $nomservice;

    /**
     * @return int
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    /**
     * @param int $idservice
     */
    public function setIdservice($idservice)
    {
        $this->idservice = $idservice;
    }

    /**
     * Set nomservice
     *
     * @param string $nomservice
     *
     * @return Service
     */
    public function setNomservice($nomservice)
    {
        $this->nomservice = $nomservice;

        return $this;
    }

    /**
     * Get nomservice
     *
     * @return string
     */
    public function getNomservice()
    {
        return $this->nomservice;
    }
}

