<?php

namespace PiDev\GestionVente\VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FavorisProduit
 *
 * @ORM\Table(name="favoris_produit")
 * @ORM\Entity(repositoryClass="PiDev\GestionVente\VenteBundle\Repository\FavorisProduitRepository")
 */
class FavorisProduit
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
     * @ORM\JoinColumn(name="userid",referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionVente\VenteBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produtid",referencedColumnName="idproduit")
     */
    private $prod;

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
    public function getProd()
    {
        return $this->prod;
    }

    /**
     * @param mixed $prod
     */
    public function setProd($prod)
    {
        $this->prod = $prod;
    }

}

