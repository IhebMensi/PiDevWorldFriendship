<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 23/02/2019
 * Time: 16:40
 */

namespace PiDev\GestionEvenement\EvenementBundle\Entity;


use SBC\NotificationsBundle\Model\BaseNotification;
use Doctrine\ORM\Mapping as ORM ;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity()
 */
class Notification extends BaseNotification implements \JsonSerializable
{



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }

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


}