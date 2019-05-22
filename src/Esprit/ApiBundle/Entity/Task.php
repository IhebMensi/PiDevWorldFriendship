<?php

namespace Esprit\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="Esprit\ApiBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtask", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtask;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @return int
     */
    public function getIdtask()
    {
        return $this->idtask;
    }

    /**
     * @param int $idtask
     */
    public function setIdtask($idtask)
    {
        $this->idtask = $idtask;
    }



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}

