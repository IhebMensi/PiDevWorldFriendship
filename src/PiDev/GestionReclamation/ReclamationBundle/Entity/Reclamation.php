<?php

namespace PiDev\GestionReclamation\ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublicite\PubliciteBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreclam", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreclam;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionreclam", type="string", length=255)
     */
    private $descriptionreclam;

    /**
     * @var string
     *
     * @ORM\Column(name="titrereclam", type="string", length=255)
     */
    private $titrereclam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datereclam", type="date")
     */
    private $datereclam;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="evenements")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionCategorie\CategorieBundle\Entity\Categorie")
     * @ORM\JoinColumn(referencedColumnName="idcategorie")
     */
    private $categorie;

    /**
     * @return int
     */
    public function getIdreclam()
    {
        return $this->idreclam;
    }

    /**
     * @param int $idreclam
     */
    public function setIdreclam($idreclam)
    {
        $this->idreclam = $idreclam;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }



    /**
     * Set descriptionreclam
     *
     * @param string $descriptionreclam
     *
     * @return Reclamation
     */
    public function setDescriptionreclam($descriptionreclam)
    {
        $this->descriptionreclam = $descriptionreclam;

        return $this;
    }

    /**
     * Get descriptionreclam
     *
     * @return string
     */
    public function getDescriptionreclam()
    {
        return $this->descriptionreclam;
    }

    /**
     * Set titrereclam
     *
     * @param string $titrereclam
     *
     * @return Reclamation
     */
    public function setTitrereclam($titrereclam)
    {
        $this->titrereclam = $titrereclam;

        return $this;
    }

    /**
     * Get titrereclam
     *
     * @return string
     */
    public function getTitrereclam()
    {
        return $this->titrereclam;
    }

    /**
     * Set datereclam
     *
     * @param \DateTime $datereclam
     *
     * @return Reclamation
     */
    public function setDatereclam($datereclam)
    {
        $this->datereclam = $datereclam;

        return $this;
    }

    /**
     * Get datereclam
     *
     * @return \DateTime
     */
    public function getDatereclam()
    {
        return $this->datereclam;
    }
}

