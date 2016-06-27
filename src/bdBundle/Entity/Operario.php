<?php

namespace bdBundle\Entity;

/**
 * Operario
 */
class Operario
{
    /**
     * @var integer
     */
    private $id;

    /**
     *@var string
     */
    private $codoperario;

    /**
     *@var string
     */
    private $nombre;


    public function __toString() {
        return (string) $this->nombre;
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Operario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set codoperario
     *
     * @param string $codoperario
     *
     * @return Operario
     */
    public function setCodoperario($codoperario)
    {
        $this->codoperario = $codoperario;

        return $this;
    }

    /**
     * Get codoperario
     *
     * @return string
     */
    public function getCodoperario()
    {
        return $this->codoperario;
    }
}
