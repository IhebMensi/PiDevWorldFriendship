<?php

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublication\PublicationBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\Column(name="contenue", type="string", length=255)
     */
    private $contenue;

    /**
     * @var string
     *
     * @ORM\Column(name="pj", type="string", length=255)
     */
    private $pj;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrvue", type="integer")
     */
    private $nbrvue;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrlike", type="integer")
     */
    private $nbrlike;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
    /**
     * @var date
     * @ORM\Column(type="date")
     */
private $datepublication;
    /**
     * @var int
     *
     * @ORM\Column(name="visibilite", type="integer")
     */
private $visibilite;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
private $userid;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionCategorie\CategorieBundle\Entity\Categorie")
     * @ORM\JoinColumn(referencedColumnName="idcategorie")
     */
    private $categorie;

    /**
     * @return int
     */

    public function getIdpublication()
    {
        return $this->idpublication;
    }

    /**
     * @param int $idpublication
     */
    public function setIdpublication($idpublication)
    {
        $this->idpublication = $idpublication;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
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
     * Set contenue
     *
     * @param string $contenue
     *
     * @return Publication
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;

        return $this;
    }

    /**
     * Get contenue
     *
     * @return string
     */
    public function getContenue()
    {
        return $this->contenue;
    }

    /**
     * Set pj
     *
     * @param string $pj
     *
     * @return Publication
     */
    public function setPj($pj)
    {
        $this->pj = $pj;

        return $this;
    }

    /**
     * Get pj
     *
     * @return string
     */
    public function getPj()
    {
        return $this->pj;
    }

    /**
     * Set nbrvue
     *
     * @param integer $nbrvue
     *
     * @return Publication
     */
    public function setNbrvue($nbrvue)
    {
        $this->nbrvue = $nbrvue;

        return $this;
    }

    /**
     * Get nbrvue
     *
     * @return int
     */
    public function getNbrvue()
    {
        return $this->nbrvue;
    }

    /**
     * Set nbrlike
     *
     * @param integer $nbrlike
     *
     * @return Publication
     */
    public function setNbrlike($nbrlike)
    {
        $this->nbrlike = $nbrlike;

        return $this;
    }

    /**
     * Get nbrlike
     *
     * @return int
     */
    public function getNbrlike()
    {
        return $this->nbrlike;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Publication
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return date
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * @param date $datepublication
     */
    public function setDatepublication($datepublication)
    {
        $this->datepublication = $datepublication;
    }

    /**
     * @return int
     */
    public function getVisibilite()
    {
        return $this->visibilite;
    }

    /**
     * @param int $visibilite
     */
    public function setVisibilite($visibilite)
    {
        $this->visibilite = $visibilite;
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

}

