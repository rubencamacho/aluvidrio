<?php

namespace bdBundle\Entity;

/**
 * Prefijo
 */
class Prefijo
{
    /**
     * @var integer
     */
    private $id;

    /**
     *@var string
     */
    private $prefijo;

    /**
     * @var string
     */
    private $descripcion;


    public function __toString() {
        return (string) $this->prefijo;
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
     * Set prefijo
     *
     * @param string $prefijo
     *
     * @return Prefijo
     */
    public function setPrefijo($prefijo)
    {
        $this->prefijo = $prefijo;

        return $this;
    }

    /**
     * Get prefijo
     *
     * @return string
     */
    public function getPrefijo()
    {
        return $this->prefijo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Prefijo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
