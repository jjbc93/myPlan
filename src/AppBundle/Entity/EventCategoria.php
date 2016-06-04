<?php

namespace AppBundle\Entity;

/**
 * EventCategoria
 */
class EventCategoria
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
     * @var \AppBundle\Entity\Categoria
     */
    private $idCategoria;


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
     * @return EventCategoria
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
     * Set idCategoria
     *
     * @param \AppBundle\Entity\Categoria $idCategoria
     *
     * @return EventCategoria
     */
    public function setIdCategoria(\AppBundle\Entity\Categoria $idCategoria = null)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
}

