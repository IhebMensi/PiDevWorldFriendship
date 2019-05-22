<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 26/02/2019
 * Time: 00:41
 */

namespace PiDev\GestionUser\FosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**
 * @ORM\Entity
 */
class MessageMetadata extends BaseMessageMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="PiDev\GestionUser\FosBundle\Entity\Message",
     *   inversedBy="metadata"
     * )
     * @var \FOS\MessageBundle\Model\MessageInterface
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $participant;
}