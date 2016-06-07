<?php

namespace AppBundle\Entity;

/**
 * EventUsuario
 */
class EventUsuario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Evento
     */
    private $idEvento;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $idUsuario;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEvento
     *
     * @param \AppBundle\Entity\Evento $idEvento
     *
     * @return EventUsuario
     */
    public function setIdEvento(\AppBundle\Entity\Evento $idEvento = null)
    {
        $this->idEvento = $idEvento;

        return $this;
    }

    /**
     * Get idEvento
     *
     * @return \AppBundle\Entity\Evento
     */
    public function getIdEvento()
    {
        return $this->idEvento;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     *
     * @return EventUsuario
     */
    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

