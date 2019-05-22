<?php

namespace PiDev\GestionVente\VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * CommentaireProduit
 *
 * @ORM\Table(name="commentaire_produit")
 * @ORM\Entity(repositoryClass="PiDev\GestionVente\VenteBundle\Repository\CommentaireProduitRepository")
 */
class CommentaireProduit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcommentaire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcommentaire;
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="Commentaires")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionVente\VenteBundle\Entity\Produit", inversedBy="Commentaires")
     * @ORM\JoinColumn(name="id_produit",referencedColumnName="idproduit",onDelete="CASCADE"))
     */
    private $produit;

    /**
     * @return int
     */
    public function getIdcommentaire()
    {
        return $this->idcommentaire;
    }

    /**
     * @param int $idcommentaire
     */
    public function setIdcommentaire($idcommentaire)
    {
        $this->idcommentaire = $idcommentaire;
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return CommentaireProduit
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }


}

