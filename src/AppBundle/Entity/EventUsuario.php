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
     * @var \AppBundle\Entity\Eventos
     */
    private $idEvento;

    /**
     * @var \AppBundle\Entity\Usuarios
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
     * @param \AppBundle\Entity\Eventos $idEvento
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
     * @return \AppBundle\Entity\Eventos
     */
    public function getIdEvento()
    {
        return $this->idEvento;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuarios $idUsuario
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
     * @return \AppBundle\Entity\Usuarios
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

