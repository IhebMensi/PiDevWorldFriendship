<?php

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * listeamis
 *
 * @ORM\Table(name="listeamis")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublication\PublicationBundle\Repository\listeamisRepository")
 */
class listeamis
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
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(name="user1",referencedColumnName="id")
     */
    private $userid1;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(name="user2",referencedColumnName="id")
     */
    private $userid2;

    /**
     * @return mixed
     */
    public function getUserid1()
    {
        return $this->userid1;
    }

    /**
     * @param mixed $userid1
     */
    public function setUserid1($userid1)
    {
        $this->userid1 = $userid1;
    }

    /**
     * @return mixed
     */
    public function getUserid2()
    {
        return $this->userid2;
    }

    /**
     * @param mixed $userid2
     */
    public function setUserid2($userid2)
    {
        $this->userid2 = $userid2;
    }


    /**
     * Get id
     *
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }
}

