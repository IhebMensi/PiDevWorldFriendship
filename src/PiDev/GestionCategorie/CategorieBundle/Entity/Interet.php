<?php

namespace PiDev\GestionCategorie\CategorieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Interet
 *
 * @ORM\Table(name="interet")
 * @ORM\Entity(repositoryClass="PiDev\GestionCategorie\CategorieBundle\Repository\InteretRepository")
 */
class Interet
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
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $userid;
    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(referencedColumnName="idcategorie")
     */
    private $categorie;


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

