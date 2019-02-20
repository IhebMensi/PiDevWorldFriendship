<?php

namespace PiDev\GestionPublicite\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * codepromo
 *
 * @ORM\Table(name="codepromo")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublicite\PubliciteBundle\Repository\codepromoRepository")
 */
class codepromo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcodepromo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcodepromo;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrpoints", type="integer")
     */
    private $nbrpoints;

    /**
     * @var string
     *
     * @ORM\Column(name="plus", type="string", length=255)
     */
    private $plus;

    /**
     * @return int
     */
    public function getIdcodepromo()
    {
        return $this->idcodepromo;
    }

    /**
     * @param int $idcodepromo
     */
    public function setIdcodepromo($idcodepromo)
    {
        $this->idcodepromo = $idcodepromo;
    }


    /**
     * Set code
     *
     * @param string $code
     *
     * @return codepromo
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nbrpoints
     *
     * @param integer $nbrpoints
     *
     * @return codepromo
     */
    public function setNbrpoints($nbrpoints)
    {
        $this->nbrpoints = $nbrpoints;

        return $this;
    }

    /**
     * Get nbrpoints
     *
     * @return int
     */
    public function getNbrpoints()
    {
        return $this->nbrpoints;
    }

    /**
     * Set plus
     *
     * @param string $plus
     *
     * @return codepromo
     */
    public function setPlus($plus)
    {
        $this->plus = $plus;

        return $this;
    }

    /**
     * Get plus
     *
     * @return string
     */
    public function getPlus()
    {
        return $this->plus;
    }
}

