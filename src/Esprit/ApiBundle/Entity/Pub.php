<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 09/02/2019
 * Time: 13:16
 */

namespace Esprit\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Pub
 *
 * @ORM\Table(name="pub")
 * @ORM\Entity(repositoryClass="Esprit\ApiBundle\Repository\PubliciteRepository")
 */
class Pub
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpublicite", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpublicite;

    /**
     * @var string
     *
     * @ORM\Column(name="nompublicite", type="string", length=255)
     */
    private $nompublicite;

    /**
     * @var string
     *
     * @ORM\Column(name="contenupublicte", type="string", length=255)
     */
    private $contenupublicte;

    /**
     * @var string
     *
     * @ORM\Column(name="nomimage", type="string", length=255,nullable=true)
     */
    private $nomimage;


    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionCategorie\CategorieBundle\Entity\Categorie")
     * @ORM\JoinColumn(referencedColumnName="idcategorie")
     */
    private $categorie;
    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
     private $pays;
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
     private  $region;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
     private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="etatreclam", type="string", length=255)
     */
    private $etat="non";

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("DateTime")
     * @Assert\GreaterThan("today")
     */
    private $datepublicite;


    /**
     * @ORM\Column(type="date")
     * @Assert\Type("DateTime")
     * @Assert\Expression("value >= this.getDatepublicite()")

     */
    private $datepublicitefin;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionPublicite\PubliciteBundle\Entity\Offre", inversedBy="publicites")
     * @ORM\JoinColumn(referencedColumnName="idoffre")
     */
    private $offr;
    /**
     * @ORM\Column(name="point", type="integer")

     */
    private $point;
    /**
     * @ORM\Column(name="prixproduit", type="integer")

     */
    private $prixproduit;
    /**
     * @ORM\Column(name="pourcentage", type="integer")

     */
    private $pourcentage;
    /**
     * @ORM\Column(name="prixremise", type="integer")

     */
    private $prixremise;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="pubs")
     * @ORM\JoinColumn(referencedColumnName="id")
     */

    private $user;

    /**
     * @ORM\Column(name="nbrprofit" , type="integer")

     */
    private $nbrprofit=0;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrlikes", type="integer")
     */
    private $nbrlikes=0;
    /**
     * @var int
     *
     * @ORM\Column(name="nbrdislikes", type="integer")
     */
    private $nbrdislikes=0;




    /**
     * @return int
     */
    public function getNbrlikes()
    {
        return $this->nbrlikes;
    }

    /**
     * @param int $nbrlikes
     */
    public function setNbrlikes($nbrlikes)
    {
        $this->nbrlikes = $nbrlikes;
    }

    /**
     * @return int
     */
    public function getNbrdislikes()
    {
        return $this->nbrdislikes;
    }

    /**
     * @param int $nbrdislikes
     */
    public function setNbrdislikes($nbrdislikes)
    {
        $this->nbrdislikes = $nbrdislikes;
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
    public function getPrixremise()
    {
        return $this->prixremise;
    }

    /**
     * @param mixed $prixremise
     */
    public function setPrixremise($prixremise)
    {
        $this->prixremise = $prixremise;
    }
    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     */
    public function setPoint($point)
    {
        $this->point = $point;
    }

    /**
     * @return mixed
     */
    public function getPrixproduit()
    {
        return $this->prixproduit;
    }

    /**
     * @param mixed $prixproduit
     */
    public function setPrixproduit($prixproduit)
    {
        $this->prixproduit = $prixproduit;
    }

    /**
     * @return mixed
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * @param mixed $pourcentage
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    /**
     * @return mixed
     */
    public function getOffr()
    {
        return $this->offr;
    }

    /**
     * @param mixed $offr
     */
    public function setOffr($offr)
    {
        $this->offr = $offr;
    }


    /**
     * @return int
     */

    public function getIdpublicite()
    {
        return $this->idpublicite;
    }

    /**
     * @param int $idpublicite
     */
    public function setIdpublicite($idpublicite)
    {
        $this->idpublicite = $idpublicite;
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
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */


    /**
     * Set nompublicite
     *
     * @param string $nompublicite
     *
     * @return Publicite
     */
    public function setNompublicite($nompublicite)
    {
        $this->nompublicite = $nompublicite;

        return $this;
    }

    /**
     * Get nompublicite
     *
     * @return string
     */
    public function getNompublicite()
    {
        return $this->nompublicite;
    }

    /**
     * Set contenupublicte
     *
     * @param string $contenupublicte
     *
     * @return Publicite
     */
    public function setContenupublicte($contenupublicte)
    {
        $this->contenupublicte = $contenupublicte;

        return $this;
    }

    /**
     * Get contenupublicte
     *
     * @return string
     */
    public function getContenupublicte()
    {
        return $this->contenupublicte;
    }






    /**
     * @return string
     */
    public function getNomimage()
    {
        return $this->nomimage;
    }

    /**
     * @param string $nomimage
     */
    public function setNomimage($nomimage)
    {
        $this->nomimage = $nomimage;
    }




    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Publicite
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @return mixed
     */
    public function getDatepublicite()
    {
        return $this->datepublicite;
    }

    /**
     * @param mixed $datepublicite
     */
    public function setDatepublicite($datepublicite)
    {
        $this->datepublicite = $datepublicite;
    }



    /**
     * @return mixed
     */
    public function getDatepublicitefin()
    {
        return $this->datepublicitefin;
    }

    /**
     * @param mixed $datepublicitefin
     */
    public function setDatepublicitefin($datepublicitefin)
    {
        $this->datepublicitefin = $datepublicitefin;
    }

    /**
     * @return mixed
     */
    public function getNbrprofit()
    {
        return $this->nbrprofit;
    }

    /**
     * @param mixed $nbrprofit
     */
    public function setNbrprofit($nbrprofit)
    {
        $this->nbrprofit = $nbrprofit;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }



}