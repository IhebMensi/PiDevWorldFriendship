<?php

namespace PiDev\GestionVente\VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="PiDev\GestionVente\VenteBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idproduit", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nomproduit", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 8
     * )
     */
    private $nomproduit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemisevente", type="date")
     *
     * @Assert\Type("DateTime")
     *@Assert\GreaterThan("today")
     */
    private $datemisevente;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $nomimage;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="produits")
     * @ORM\JoinColumn(name="userid",referencedColumnName="id")
     */
    private $user;
    /**
     * @var string
     *
     * @ORM\Column(name="AcptProd", type="string",length=255)
     */
    private $AcptProd;
    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string",length=255)
     */
    private $categorie;
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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat='non';
    /**
     * @var string
     *
     * @ORM\Column(name="descriptionproduit", type="string", length=255)
     */
    private $descriptionproduit;
    /**
     * @Assert\File(maxSize="5000k")
     */
    public $file;

    /**
     * @return int
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param int $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
    }




    /**
     * Set nomproduit
     *
     * @param string $nomproduit
     *
     * @return Produit
     */
    public function setNomproduit($nomproduit)
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }

    /**
     * Get nomproduit
     *
     * @return string
     */
    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    /**
     * Set datemisevente
     *
     * @param \DateTime $datemisevente
     *
     * @return Produit
     */
    public function setDatemisevente($datemisevente)
    {
        $this->datemisevente = $datemisevente;

        return $this;
    }

    /**
     * Get datemisevente
     *
     * @return \DateTime
     */
    public function getDatemisevente()
    {
        return $this->datemisevente;
    }

    /**
     * Set nomimage
     *
     * @param string $nomimage
     *
     * @return Produit
     */
    public function setNomimage($nomimage)
    {
        $this->nomimage = $nomimage;

        return $this;
    }

    /**
     * Get nomimage
     *
     * @return string
     */
    public function getNomimage()
    {
        return $this->nomimage;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
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
   /* public function getWebPath()
    {
        return null===$this->image ? null : $this->getUploadDir.'/'.$this->nomimage;
    }
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();

    }

    public function getUploadDir()
    {
        return 'images';
    }

    public function uploadProfilePicture()
    {
        if (null === $this->file) {
            return;
        }
        if(!$this->idproduit){
            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        }else{

            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        }
        $this->setNomimage($this->file->getClientOriginalName());
    }*/

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
     * @return string
     */
    public function getDescriptionproduit()
    {
        return $this->descriptionproduit;
    }

    /**
     * @param string $descriptionproduit
     */
    public function setDescriptionproduit($descriptionproduit)
    {
        $this->descriptionproduit = $descriptionproduit;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
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
/*
    /**
     * @return mixed
     */
 /*   public function getIdcom()
    {
        return $this->idcom;
    }

    /**
     * @param mixed $idcom
     */
 /*   public function setIdcom($idcom)
    {
        $this->idcom = $idcom;
    }*/

    /**
     * @return string
     */
  /**  public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param string $pays
     */
   /** public function setPays($pays)
    {
        $this->pays = $pays;
    }*/

    /**
     * @return string
     */
    public function getAcptProd()
    {
        return $this->AcptProd;
    }

    /**
     * @param string $AcptProd
     */
    public function setAcptProd($AcptProd)
    {
        $this->AcptProd = $AcptProd;
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

