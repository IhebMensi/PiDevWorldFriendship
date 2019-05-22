<?php

namespace  Esprit\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="Esprit\ApiBundle\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idevenement", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idevenement;


    /**
     * @var string
     *
     * @ORM\Column(name="nomevenement", type="string", length=255)
     */
    private $nomevenement;

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
    private $region;
    /**
     *
     *
     *
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="datetime")
     *
     * @Assert\Type("DateTime")
     *
     * @Assert\GreaterThan("today")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     *
     * @Assert\Type("DateTime")
     *
     * @Assert\Expression("value >= this.getDatedebut()")
     */
    private $datefin;

    /**
     * @var string
     * @ORM\Column(name="descriptionevenement", type="text", length=255)
     */
    private $descriptionevenement;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrparticipants", type="integer")
     */
    private $nbrparticipants=0;



    /**
     * @var int
     *
     * @ORM\Column(name="nbrplacestotal", type="integer")
     */

    private $nbrplacestotal;

    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=255)
     */
    private $payment;
    /**
     * @var int
     *
     * @ORM\Column(name="nbrtickets", type="integer")
     */
    private $nbrtickets=0;

    /**
     * @var int
     *
     * @ORM\Column(name="prixtickets", type="integer")
     */
    private $prixtickets=0;


    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    public $nomimage;

    /**
     * @Assert\File(maxSize="5000k")
     */
    public $file;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="evenements")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;


    /**
     *
     * @ORM\ManyToOne(targetEntity="PiDev\GestionCategorie\CategorieBundle\Entity\Categorie")
     * @ORM\JoinColumn(referencedColumnName="idcategorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionEvenement\EvenementBundle\Entity\TypeEvenement")
     * @ORM\JoinColumn(referencedColumnName="idtype")
     */
   private $typeevenement;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionPublicite\PubliciteBundle\Entity\Lieu")
     * @ORM\JoinColumn(referencedColumnName="idlieu")
     */
    private $lieu;



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
     * @var int
     *
     * @ORM\Column(name="nbsignal", type="integer")
     */
    private $nbsignal=0;

    /**
     * @return int
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * @param int $idevenement
     */
    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;
    }

    /**
     * @return string
     */
    public function getNomevenement()
    {
        return $this->nomevenement;
    }

    /**
     * @param string $nomevenement
     */
    public function setNomevenement($nomevenement)
    {
        $this->nomevenement = $nomevenement;
    }

    /**
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param string $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return string
     */
    public function getDescriptionevenement()
    {
        return $this->descriptionevenement;
    }

    /**
     * @param string $descriptionevenement
     */
    public function setDescriptionevenement($descriptionevenement)
    {
        $this->descriptionevenement = $descriptionevenement;
    }

    /**
     * @return int
     */
    public function getNbrparticipants()
    {
        return $this->nbrparticipants;
    }

    /**
     * @param int $nbrparticipants
     */
    public function setNbrparticipants($nbrparticipants)
    {
        $this->nbrparticipants = $nbrparticipants;
    }

    /**
     * @return int
     */
    public function getNbrplacestotal()
    {
        return $this->nbrplacestotal;
    }

    /**
     * @param int $nbrplacestotal
     */
    public function setNbrplacestotal($nbrplacestotal)
    {
        $this->nbrplacestotal = $nbrplacestotal;
    }

    /**
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param string $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return int
     */
    public function getNbrtickets()
    {
        return $this->nbrtickets;
    }

    /**
     * @param int $nbrtickets
     */
    public function setNbrtickets($nbrtickets)
    {
        $this->nbrtickets = $nbrtickets;
    }

    /**
     * @return int
     */
    public function getPrixtickets()
    {
        return $this->prixtickets;
    }

    /**
     * @param int $prixtickets
     */
    public function setPrixtickets($prixtickets)
    {
        $this->prixtickets = $prixtickets;
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
     * @return mixed
     */
   public function getTypeevenement()
   {
      return $this->typeevenement;
   }

    /**
     * @param mixed $typeevenement
     */
   public function setTypeevenement($typeevenement)
    {
      $this->typeevenement = $typeevenement;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

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




    public function getWebPath()
    {
        return null===$this->nomimage ? null : $this->getUploadDir().'/'.$this->nomimage;
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
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        $this->nomimage=$this->file->getClientOriginalName();
        $this->file=null;
    }

    /**
     * @return mixed
     */
    public function getNomimage()
    {
        return $this->nomimage;
    }

    /**
     * @param mixed $nomimage
     */
    public function setNomimage($nomimage)
    {
        $this->nomimage = $nomimage;
        return $this;
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
    public function getNbsignal()
    {
        return $this->nbsignal;
    }

    /**
     * @param int $nbsignal
     */
    public function setNbsignal($nbsignal)
    {
        $this->nbsignal = $nbsignal;
    }



}

