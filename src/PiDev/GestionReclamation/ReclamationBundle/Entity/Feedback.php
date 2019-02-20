<?php

namespace PiDev\GestionReclamation\ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="PiDev\GestionReclamation\ReclamationBundle\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @var int
     *
     * @ORM\Column(name="idfeedback", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfeedback;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="evenements")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumn(referencedColumnName="idservice")
     */
    private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionfeedback", type="string", length=255)
     */
    private $descriptionfeedback;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefeedback", type="date")
     */
    private $datefeedback;


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
     * @return Feedback
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
     * Set descriptionfeedback
     *
     * @param string $descriptionfeedback
     *
     * @return Feedback
     */
    public function setDescriptionfeedback($descriptionfeedback)
    {
        $this->descriptionfeedback = $descriptionfeedback;

        return $this;
    }

    /**
     * Get descriptionfeedback
     *
     * @return string
     */
    public function getDescriptionfeedback()
    {
        return $this->descriptionfeedback;
    }

    /**
     * Set datefeedback
     *
     * @param \DateTime $datefeedback
     *
     * @return Feedback
     */
    public function setDatefeedback($datefeedback)
    {
        $this->datefeedback = $datefeedback;

        return $this;
    }

    /**
     * Get datefeedback
     *
     * @return \DateTime
     */
    public function getDatefeedback()
    {
        return $this->datefeedback;
    }

    /**
     * @return int
     */
    public function getIdfeedback()
    {
        return $this->idfeedback;
    }

    /**
     * @param int $idfeedback
     */
    public function setIdfeedback($idfeedback)
    {
        $this->idfeedback = $idfeedback;
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
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

}

