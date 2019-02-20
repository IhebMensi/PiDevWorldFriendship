<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 16/02/2019
 * Time: 19:17
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity
 */
class Offre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idoffre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
private $idoffre;

    /**
     * @var string
     *
     * @ORM\Column(name="nomoffre", type="string", length=255)
     */
private $nomoffre;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer")
     */
private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
private $descriptionoffre;
    /**
     * @ORM\OneToMany(targetEntity="PiDev\GestionPublicite\PubliciteBundle\Entity\Pub", mappedBy="offr")
     */
    private $publicites;
    /**
     * @return mixed
     */
    public function getIdoffre()
    {
        return $this->idoffre;
    }

    /**
     * @param mixed $idoffre
     */
    public function setIdoffre($idoffre)
    {
        $this->idoffre = $idoffre;
    }

    /**
     * @return mixed
     */
    public function getNomoffre()
    {
        return $this->nomoffre;
    }

    /**
     * @param mixed $nomoffre
     */
    public function setNomoffre($nomoffre)
    {
        $this->nomoffre = $nomoffre;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    }

    /**
     * @return mixed
     */
    public function getDescriptionoffre()
    {
        return $this->descriptionoffre;
    }

    /**
     * @param mixed $descriptionoffre
     */
    public function setDescriptionoffre($descriptionoffre)
    {
        $this->descriptionoffre = $descriptionoffre;
    }

    /**
     * @return mixed
     */
    public function getPublicites()
    {
        return $this->publicites;
    }

    /**
     * @param mixed $publicites
     */
    public function setPublicites($publicites)
    {
        $this->publicites = $publicites;
    }

}