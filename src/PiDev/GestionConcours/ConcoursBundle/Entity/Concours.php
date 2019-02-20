<?php

namespace PiDev\GestionConcours\ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Concours
 *
 * @ORM\Table(name="concours")
 * @ORM\Entity(repositoryClass="PiDev\GestionConcours\ConcoursBundle\Repository\ConcoursRepository")
 */
class Concours
{
    /**
     * @var int
     *
     * @ORM\Column(name="idconcours", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idconcours;

    /**
     * @var string
     *
     * @ORM\Column(name="nomconcours", type="string", length=255)
     */
    private $nomconcours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionCategorie\CategorieBundle\Entity\Categorie")
     * @ORM\JoinColumn(referencedColumnName="idcategorie")
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionconcours", type="string", length=255)
     */

    private $descriptionconcours;
    /**
     * @var string
     *
     * @ORM\Column(name="prixgagnant", type="string", length=255)
     */
    private $prixgagnant;




    /**
     * Set nomconcours
     *
     * @param string $nomconcours
     *
     * @return Concours
     */
    public function setNomconcours($nomconcours)
    {
        $this->nomconcours = $nomconcours;

        return $this;
    }

    /**
     * Get nomconcours
     *
     * @return string
     */
    public function getNomconcours()
    {
        return $this->nomconcours;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Concours
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Concours
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
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
     * Set descriptionconcours
     *
     * @param string $descriptionconcours
     *
     * @return Concours
     */
    public function setDescriptionconcours($descriptionconcours)
    {
        $this->descriptionconcours = $descriptionconcours;

        return $this;
    }

    /**
     * Get descriptionconcours
     *
     * @return string
     */
    public function getDescriptionconcours()
    {
        return $this->descriptionconcours;
    }

    /**
     * @return int
     */
    public function getIdconcours()
    {
        return $this->idconcours;
    }

    /**
     * @param int $idconcours
     */
    public function setIdconcours($idconcours)
    {
        $this->idconcours = $idconcours;
    }

    /**
     * @return mixed
     */
    public function getPrixgagnant()
    {
        return $this->prixgagnant;
    }

    /**
     * @param mixed $prixgagnant
     */
    public function setPrixgagnant($prixgagnant)
    {
        $this->prixgagnant = $prixgagnant;
    }
}

