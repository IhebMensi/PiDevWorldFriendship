<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 26/02/2019
 * Time: 00:33
 */

namespace PiDev\GestionUser\FosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Message as BaseMessage;


    /**
     * @ORM\Entity
     */
class Message extends BaseMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="PiDev\GestionUser\FosBundle\Entity\Thread",
     *   inversedBy="messages"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="PiDev\GestionUser\FosBundle\Entity\MessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata[]|Collection
     */
    protected $metadata;

}
