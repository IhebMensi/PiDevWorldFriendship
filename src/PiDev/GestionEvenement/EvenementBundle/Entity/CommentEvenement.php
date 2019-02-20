<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 19/02/2019
 * Time: 12:02
 */

namespace PiDev\GestionEvenement\EvenementBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class CommentEvenement
 * @ORM\Table(name="Comment_Evenement")
 * @ORM\Entity(repositoryClass="PiDev\GestionEvenement\EvenementBundle\Repository\CommentEvenementRepository")
 */

class CommentEvenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idComment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idComment;


    /**
     *
     * @ORM\ManyToOne(targetEntity="PiDev\GestionEvenement\EvenementBundle\Entity\Evenement", inversedBy="CommentEvenement"))
     * @ORM\JoinColumn(name="even_id",referencedColumnName="idevenement" , onDelete="CASCADE")
     */
    private $event;

    /**
     *
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="CommentEvenement")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE" )
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }



}