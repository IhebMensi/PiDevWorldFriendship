<?php

namespace PiDev\GestionCategorie\CategorieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="PiDev\GestionCategorie\CategorieBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcategorie", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcategorie", type="string", length=255)
     */
    private $nomcategorie;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrabonnees", type="integer")
     */
    private $nbrabonnees;
    /**
     * @var string
     *
     * @ORM\Column(name="imgcatgorie", type="string", length=255)
     */
    private $imagecategorie;
    /**
     * @var string
     *
     * @ORM\Column(name="descriptioncategorie",type="string", length=255)
     */
    private $descriptioncategorie;

    /**
     * @return int
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    /**
     * @param int $idcategorie
     */
    public function setIdcategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }



    /**
     * Set nomcategorie
     *
     * @param string $nomcategorie
     *
     * @return Categorie
     */
    public function setNomcategorie($nomcategorie)
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    /**
     * Get nomcategorie
     *
     * @return string
     */
    public function getNomcategorie()
    {
        return $this->nomcategorie;
    }

    /**
     * Set nbrabonnees
     *
     * @param integer $nbrabonnees
     *
     * @return Categorie
     */
    public function setNbrabonnees($nbrabonnees)
    {
        $this->nbrabonnees = $nbrabonnees;

        return $this;
    }

    /**
     * Get nbrabonnees
     *
     * @return int
     */
    public function getNbrabonnees()
    {
        return $this->nbrabonnees;
    }

    /**
     * @return string
     */
    public function getImagecategorie()
    {
        return $this->imagecategorie;
    }

    /**
     * @param string $imagecategorie
     */
    public function setImagecategorie($imagecategorie)
    {
        $this->imagecategorie = $imagecategorie;
    }

    /**
     * @return string
     */
    public function getDescriptioncategorie()
    {
        return $this->descriptioncategorie;
    }

    /**
     * @param string $descriptioncategorie
     */
    public function setDescriptioncategorie($descriptioncategorie)
    {
        $this->descriptioncategorie = $descriptioncategorie;
    }
}

