<?php

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="nbrvue", type="integer")
     */
    private $nbrvue=0;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrlike", type="integer")
     */
    private $nbrlike=0;
    /**
     * @var int
     *
     * @ORM\Column(name="nbrdislike", type="integer")
     */
    private $nbrdislike=0;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepublication", type="datetime")
     *
     * @Assert\Type("DateTime")
     *
     */
private $datepublication;
    /**
     * @var int
     *
     * @ORM\Column(name="visibilite", type="integer")
     */
private $visibilite=1;
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
     * @var int
     *
     * @ORM\Column(name="nbrsignalisation", type="integer")
     */
    private $nbrsignalisation=0;

    /**
     * @return int
     */
    public function getNbrsignalisation()
    {
        return $this->nbrsignalisation;
    }

    /**
     * @param int $nbrsignalisation
     */
    public function setNbrsignalisation($nbrsignalisation)
    {
        $this->nbrsignalisation = $nbrsignalisation;
    }



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContenue()
    {
        return $this->contenue;
    }

    /**
     * @param string $contenue
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;
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
    public function getNbrvue()
    {
        return $this->nbrvue;
    }

    /**
     * @param int $nbrvue
     */
    public function setNbrvue($nbrvue)
    {
        $this->nbrvue = $nbrvue;
    }

    /**
     * @return int
     */
    public function getNbrlike()
    {
        return $this->nbrlike;
    }

    /**
     * @param int $nbrlike
     */
    public function setNbrlike($nbrlike)
    {
        $this->nbrlike = $nbrlike;
    }

    /**
     * @return int
     */
    public function getNbrdislike()
    {
        return $this->nbrdislike;
    }

    /**
     * @param int $nbrdislike
     */
    public function setNbrdislike($nbrdislike)
    {
        $this->nbrdislike = $nbrdislike;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return \DateTime
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * @param \DateTime $datepublication
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
        if (null === $this->file) {
            return;
        }
        if(!$this->id){
            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        }else{

            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        }
        $this->setNomimage($this->file->getClientOriginalName());
    }

}

