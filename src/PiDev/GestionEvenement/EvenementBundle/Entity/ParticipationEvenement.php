<?php

namespace PiDev\GestionEvenement\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ParticipationEvenement
 *
 * @ORM\Table(name="participation_evenement")
 * @ORM\Entity(repositoryClass="PiDev\GestionEvenement\EvenementBundle\Repository\ParticipationEvenementRepository")
 */
class ParticipationEvenement
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionEvenement\EvenementBundle\Entity\Evenement", inversedBy="ParticipationEvenement"))
     * @ORM\JoinColumn(name="even_id",referencedColumnName="idevenement" , onDelete="CASCADE")
     */
    private $even;

    /**
     *  @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="ParticipationEvenement")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE" )
     */
    private $user;


    /**
     * @return mixed
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * @param mixed $even
     */
    public function setEven($even)
    {
        $this->even = $even;
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

