<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 25/02/2019
 * Time: 16:08
 */

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Publication
 *
 * @ORM\Table(name="reactionpublication")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublication\PublicationBundle\Repository\PublicationRepository")
 */
class ReactionPub
{


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionPublication\PublicationBundle\Entity\Publication", inversedBy="ReactionEvenement"))
     * @ORM\JoinColumn(name="pub_id",referencedColumnName="id" , onDelete="CASCADE")
     */
    private $Pub;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="ReactionEvenement")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE" )
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $reaction;

    /**
     * @return mixed
     */
    public function getPub()
    {
        return $this->Pub;
    }

    /**
     * @param mixed $Pub
     */
    public function setPub($Pub)
    {
        $this->Pub = $Pub;
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
     * @return string
     */
    public function getReaction()
    {
        return $this->reaction;
    }

    /**
     * @param string $reaction
     */
    public function setReaction($reaction)
    {
        $this->reaction = $reaction;
    }





}