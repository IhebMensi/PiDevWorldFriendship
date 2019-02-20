<?php

namespace PiDev\GestionConcours\ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * ParticipationConcours
 *
 * @ORM\Table(name="participation_concours")
 * @ORM\Entity(repositoryClass="PiDev\GestionConcours\ConcoursBundle\Repository\ParticipationConcoursRepository")
 */
class ParticipationConcours
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
     * @ORM\Column(name="note", type="integer")
     */
    private $note;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(name="userid",referencedColumnName="id")
     */
    private $userid;
    /**
     * @ORM\ManyToOne(targetEntity="Concours")
     * @ORM\JoinColumn(referencedColumnName="idconcours")
     */
    private $concours;


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
     * Set note
     *
     * @param integer $note
     *
     * @return ParticipationConcours
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
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

    /**
     * @return mixed
     */
    public function getConcours()
    {
        return $this->concours;
    }

    /**
     * @param mixed $concours
     */
    public function setConcours($concours)
    {
        $this->concours = $concours;
    }
}

