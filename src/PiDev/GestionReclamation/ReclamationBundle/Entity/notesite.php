<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 22/02/2019
 * Time: 17:16
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="notesite")
 * @ORM\Entity(repositoryClass="PiDev\GestionReclamation\ReclamationBundle\Repository\FeedbackRepository")
 */

class notesite
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
     * @var float
     *
     * @ORM\Column(name="note", type="float",precision=10, scale=0)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="notesite")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;

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
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param float $note
     */
    public function setNote($note)
    {
        $this->note = $note;
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


}

