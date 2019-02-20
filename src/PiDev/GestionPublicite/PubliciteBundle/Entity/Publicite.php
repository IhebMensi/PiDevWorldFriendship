<?php

namespace PiDev\GestionPublicite\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Publicite
 *
 * @ORM\Table(name="publicite")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublicite\PubliciteBundle\Repository\PubliciteRepository")
 */
class Publicite
{
    /**
     * @var int
     *
     * @ORM\Column(name="idiheb", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idiheb;
    /**
     * @var string
     *
     * @ORM\Column(name="nomiheb", type="string", length=255)
     */
    private $nomiheb;

    /**
     * @return string
     */
    public function getNomiheb()
    {
        return $this->nomiheb;
    }

    /**
     * @param string $nomiheb
     */
    public function setNomiheb($nomiheb)
    {
        $this->nomiheb = $nomiheb;
    }

    /**
     * @return int
     */
    public function getIdiheb()
    {
        return $this->idiheb;
    }

    /**
     * @param int $idiheb
     */
    public function setIdiheb($idiheb)
    {
        $this->idiheb = $idiheb;
    }

}

