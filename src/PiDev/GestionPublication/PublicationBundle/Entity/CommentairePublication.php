<?php

namespace PiDev\GestionPublication\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PiDev\GestionUser\FosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * CommentairePublication
 *
 * @ORM\Table(name="commentaire_publication")
 * @ORM\Entity(repositoryClass="PiDev\GestionPublication\PublicationBundle\Repository\CommentairePublicationRepository")
 */
class CommentairePublication
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcmmentairepublication", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcommentairepublication;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;
    /**
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(name="idpublication",referencedColumnName="id")
     */
    private $idPublication;
    /**
     * @ORM\ManyToOne(targetEntity="PiDev\GestionUser\FosBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $userid;

    /**
     * @return int
     */
    public function getIdcommentairepublication()
    {
        return $this->idcommentairepublication;
    }

    /**
     * @param int $idcommentairepublication
     */
    public function setIdcommentairepublication($idcommentairepublication)
    {
        $this->idcommentairepublication = $idcommentairepublication;
    }

    /**
     * @return mixed
     */
    public function getIdPublication()
    {
        return $this->idPublication;
    }

    /**
     * @param mixed $idPublication
     */
    public function setIdPublication($idPublication)
    {
        $this->idPublication = $idPublication;
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return CommentairePublication
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

