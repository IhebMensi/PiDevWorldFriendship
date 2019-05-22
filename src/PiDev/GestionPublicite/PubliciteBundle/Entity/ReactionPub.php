<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 21/02/2019
 * Time: 15:43
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Entity;




use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Pub
 *
 * @ORM\Table(name="ReactionPub")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublicite\PubliciteBundle\Entity\PubRepository")
 *
 **/
class ReactionPub
{


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionPublicite\PubliciteBundle\Entity\Pub", inversedBy="ReactionPub")
     * @ORM\JoinColumn(name="pub_id", referencedColumnName="idpublicite", onDelete="CASCADE")
     */
    protected $Pub;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="ReactionPub")
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