<?php

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * like_dislike
 *
 * @ORM\Table(name="like_dislike")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublication\PublicationBundle\Repository\like_dislikeRepository")
 */
class like_dislike
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
     * @var int
     *
     * @ORM\Column(name="likedislike", type="integer")
     */
    private $likedislike;
    /**
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $idPublication;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $userid;

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
     * Set likedislike
     *
     * @param integer $likedislike
     *
     * @return like_dislike
     */
    public function setLikedislike($likedislike)
    {
        $this->likedislike = $likedislike;

        return $this;
    }

    /**
     * Get likedislike
     *
     * @return int
     */
    public function getLikedislike()
    {
        return $this->likedislike;
    }

    /**
     * @return mixed
     */
    public function getIdPublication()
    {
        return $this->idPublication;
    }

    /**
     * @param mixed $idPublication
     */
    public function setIdPublication($idPublication)
    {
        $this->idPublication = $idPublication;
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
}

