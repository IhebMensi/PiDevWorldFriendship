<?php

namespace PiDev\GestionVente\VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;


/**
 *
 * @ORM\Table(name="Reaction_produit")
 * @ORM\Entity
 *
 **/
class ReactionProduit
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionVente\VenteBundle\Entity\Produit", inversedBy="ReactionProduit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="idproduit", onDelete="CASCADE")
     */
    protected $produit;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="ReactionProduit")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $User;


    /**
     * @var string
     *
     * @ORM\Column(name="reaction", type="string", length=255)
     */
    private $reaction;


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
     * Set reaction
     *
     * @param string $reaction
     *
     * @return ReactionProduit
     */
    public function setReaction($reaction)
    {
        $this->reaction = $reaction;

        return $this;
    }

    /**
     * Get reaction
     *
     * @return string
     */
    public function getReaction()
    {
        return $this->reaction;
    }

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }


}

