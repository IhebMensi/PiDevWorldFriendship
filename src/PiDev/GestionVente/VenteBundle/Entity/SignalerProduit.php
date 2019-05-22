<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 25/02/2019
 * Time: 17:56
 */

namespace PiDev\GestionVente\VenteBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * SignalerProduit
 *
 * @ORM\Table(name="Signaler_Produit")
 * @ORM\Entity
 */
class SignalerProduit
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
     * @var integer
     *
     * @ORM\Column(name="Nbsig")
     */
    private $Nbsig=0;

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

    /**
     * @return int
     */
    public function getNbsig()
    {
        return $this->Nbsig;
    }

    /**
     * @param int $Nbsig
     */
    public function setNbsig($Nbsig)
    {
        $this->Nbsig = $Nbsig;
    }



}