<?php

namespace PiDev\GestionEvenement\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="PiDev\GestionEvenement\EvenementBundle\Repository\EvenementRepository")
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
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    public $nomimage;

    /**
     * @Assert\File(maxSize="5000k")
     */
    public $file;
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
     * @ORM\ManyToOne(targetEntity="TypeEvenement")
     * @ORM\JoinColumn(referencedColumnName="idtype")
     */
    private $typeevenement;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionPublicite\PubliciteBundle\Entity\Lieu")
     * @ORM\JoinColumn(referencedColumnName="idlieu")
     */
    private $lieu;

    /**
     * @return int
     */

    public function getIdevenement()
    {
        return $this->idevenement;
    }



    /**
     * Set nomevenement
     *
     * @param string $nomevenement
     *
     * @return Evenement
     */
    public function setNomevenement($nomevenement)
    {
        $this->nomevenement = $nomevenement;

        return $this;
    }

    /**
     * Get nomevenement
     *
     * @return string
     */
    public function getNomevenement()
    {
        return $this->nomevenement;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Evenement
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
     * @param string $datefin
     *
     * @return Evenement
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return string
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @return mixed
     */
    public function getParevent()
    {
        return $this->parevent;
    }

    /**
     * @param mixed $parevent
     */
    public function setParevent($parevent)
    {
        $this->parevent = $parevent;
    }



    /**
     * Set descriptionevenement
     *
     * @param string $descriptionevenement
     *
     * @return Evenement
     */
    public function setDescriptionevenement($descriptionevenement)
    {
        $this->descriptionevenement = $descriptionevenement;

        return $this;
    }

    /**
     * Get descriptionevenement
     *
     * @return string
     */
    public function getDescriptionevenement()
    {
        return $this->descriptionevenement;
    }

    /**
     * Set nbrparticipants
     *
     * @param integer $nbrparticipants
     *
     * @return Evenement
     */
    public function setNbrparticipants($nbrparticipants)
    {
        $this->nbrparticipants = $nbrparticipants;

        return $this;
    }

    /**
     * Get nbrparticipants
     *
     * @return int
     */
    public function getNbrparticipants()
    {
        return $this->nbrparticipants;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Evenement
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
     * Set nbrplacestotal
     *
     * @param integer $nbrplacestotal
     *
     * @return Evenement
     */
    public function setNbrplacestotal($nbrplacestotal)
    {
        $this->nbrplacestotal = $nbrplacestotal;

        return $this;
    }

    /**
     * Get nbrplacestotal
     *
     * @return int
     */
    public function getNbrplacestotal()
    {
        return $this->nbrplacestotal;
    }

    /**
     * Set nbrtickets
     *
     * @param integer $nbrtickets
     *
     * @return Evenement
     */
    public function setNbrtickets($nbrtickets)
    {
        $this->nbrtickets = $nbrtickets;

        return $this;
    }

    /**
     * Get nbrtickets
     *
     * @return int
     */
    public function getNbrtickets()
    {
        return $this->nbrtickets;
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


}

