<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 19/02/2019
 * Time: 13:54
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfitePub
 *
 * @ORM\Table(name="ProfitePub")
 * @ORM\Entity
 */
class ProfitePub
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionPublicite\PubliciteBundle\Entity\Pub", inversedBy="ProfitePub"))
     * @ORM\JoinColumn(name="pub_id",referencedColumnName="idpublicite" , onDelete="CASCADE")
     */
    private $pub;

    /**
     *  @ORM\Id
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User", inversedBy="ProfitePub")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", onDelete="CASCADE" )
     */
    private $user;

    /**
     * @return mixed
     */
    public function getPub()
    {
        return $this->pub;
    }

    /**
     * @param mixed $pub
     */
    public function setPub($pub)
    {
        $this->pub = $pub;
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