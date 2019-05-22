<?php
// src/AppBundle/Entity/User.php

namespace PiDev\GestionUser\FosBundle\Entity;
use FOS\MessageBundle\Model\ParticipantInterface;
use PiDev\GestionPublication\PublicationBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
/**
* @ORM\OneToMany(targetEntity="PiDev\GestionVente\VenteBundle\Entity\Produit", mappedBy="user")
*/
 /**   private $produits;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $monimage;

    /**
     * @Assert\File(maxSize="5000k")
     */
    public $file;
    /**
     * @ORM\Column(type="string",length=255)
     */

  private $Pays;
    /**
     * @ORM\Column(type="integer")
     */
  private $NumeroTel;
    /**
     * @ORM\Column(type="date")
     */
    private $DatedeNaissance;

    /**
     * @return mixed
     */
    public function getDatedeNaissance()
    {
        return $this->DatedeNaissance;
    }

    /**
     * @param mixed $DatedeNaissance
     */
    public function setDatedeNaissance($DatedeNaissance)
    {
        $this->DatedeNaissance = $DatedeNaissance;
    }
    /**
     * @ORM\Column(type="integer")
     */
    private $Point=500;
    /**
     * @ORM\Column(type="string",length=255)
     */
  private $region;

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->Pays;
    }

    /**
     * @param mixed $Pays
     */
    public function setPays($Pays)
    {
        $this->Pays = $Pays;
    }


    /**
     * @return mixed
     */
    public function getNumeroTel()
    {
        return $this->NumeroTel;
    }

    /**
     * @param mixed $NumeroTel
     */
    public function setNumeroTel($NumeroTel)
    {
        $this->NumeroTel = $NumeroTel;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->Point;
    }

    /**
     * @param mixed $Point
     */
    public function setPoint($Point)
    {
        $this->Point = $Point;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
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
/**    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * @param mixed $produits
     */
 /**   public function setProduits($produits)
    {
        $this->produits = $produits;
    }
*/


    public function getWebPath()
    {
        //return null===$this->image ? null : $this->getUploadDir.'/'.$this->monimage;
    }
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();

    }

    public function getUploadDir()
    {
        return 'images';
    }

    public function  uploadProfilePicture()
    {
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->monimage=$this->file->getClientOriginalName();
        $this->file=null;
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
     * @return mixed
     */
    public function getMonimage()
    {
        return $this->monimage;
    }

    /**
     * @param mixed $monimage
     */
    public function setMonimage($monimage)
    {
        $this->monimage = $monimage;
    }


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}