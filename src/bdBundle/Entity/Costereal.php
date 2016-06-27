<?php

namespace bdBundle\Entity;

/**
 * Costereal
 */
class Costereal
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $coste;

    /**
     * @var \bdBundle\Entity\Obra
     */
    private $obra;

    /**
     * @var \bdBundle\Entity\Productosobra
     */
    private $producto;


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
     * Set coste
     *
     * @param float $coste
     *
     * @return Costereal
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;

        return $this;
    }

    /**
     * Get coste
     *
     * @return float
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * Set obra
     *
     * @param \bdBundle\Entity\Obra $obra
     *
     * @return Costereal
     */
    public function setObra(\bdBundle\Entity\Obra $obra = null)
    {
        $this->obra = $obra;

        return $this;
    }

    /**
     * Get obra
     *
     * @return \bdBundle\Entity\Obra
     */
    public function getObra()
    {
        return $this->obra;
    }

    /**
     * Set producto
     *
     * @param \bdBundle\Entity\Productosobra $producto
     *
     * @return Costereal
     */
    public function setProducto(\bdBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \bdBundle\Entity\Productosobra
     */
    public function getProducto()
    {
        return $this->producto;
    }
}
