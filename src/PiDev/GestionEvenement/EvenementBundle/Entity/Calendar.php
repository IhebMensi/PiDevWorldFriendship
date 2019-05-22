<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 25/02/2019
 * Time: 09:49
 */

namespace PiDev\GestionEvenement\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * test
 *
 * @ORM\Table(name="Calendar")
 * @ORM\Entity(repositoryClass="PiDev\GestionEvenement\EvenementBundle\Repository\EvenementRepository")
 */
class Calendar
{


    /**
     * @var int
     *
     * @ORM\Column(name="iidcal", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcal;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcal", type="string", length=255)
     */
    private $nomcal;

  /**
   * @var string
   *
   * @ORM\Column(name="descriptioncal", type="string", length=255)
   */
    private $descriptioncal;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecald", type="datetime")
     *
     * @Assert\Type("DateTime")
     *
     * @Assert\GreaterThan("today")
     */
    private $datecald;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     *
     * @Assert\Type("DateTime")
     *
     * @Assert\Expression("value >= this.getDatecald()")
     */
    private $datecalf;

    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="evenements")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;

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
     * @return int
     */
    public function getIdcal()
    {
        return $this->idcal;
    }

    /**
     * @param int $idcal
     */
    public function setIdcal($idcal)
    {
        $this->idcal = $idcal;
    }

    /**
     * @return string
     */
    public function getNomcal()
    {
        return $this->nomcal;
    }

    /**
     * @param string $nomcal
     */
    public function setNomcal($nomcal)
    {
        $this->nomcal = $nomcal;
    }

    /**
     * @return string
     */
    public function getDescriptioncal()
    {
        return $this->descriptioncal;
    }

    /**
     * @param string $descriptioncal
     */
    public function setDescriptioncal($descriptioncal)
    {
        $this->descriptioncal = $descriptioncal;
    }

    /**
     * @return mixed
     */
    public function getDatecald()
    {
        return $this->datecald;
    }

    /**
     * @param mixed $datecald
     */
    public function setDatecald($datecald)
    {
        $this->datecald = $datecald;
    }

    /**
     * @return mixed
     */
    public function getDatecalf()
    {
        return $this->datecalf;
    }

    /**
     * @param mixed $datecalf
     */
    public function setDatecalf($datecalf)
    {
        $this->datecalf = $datecalf;
    }






}