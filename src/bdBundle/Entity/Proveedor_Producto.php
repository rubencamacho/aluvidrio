<?php

namespace bdBundle\Entity;

/**
 * Proveedor_Producto
 */
class Proveedor_Producto
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $proveedor;

    private $producto;

    private $precio;

    public function __construct() {
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return (string) $this->proveedor;
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
     * Set codprov
     *
     * @param string $codprov
     *
     * @return Proveedor_Producto
     */
    public function setCodprov($codprov)
    {
        $this->codprov = $codprov;

        return $this;
    }

    /**
     * Get codprov
     *
     * @return string
     */
    public function getCodprov()
    {
        return $this->codprov;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return Proveedor_Producto
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set producto
     *
     * @param \bdBundle\Entity\Producto $producto
     *
     * @return Proveedor_Producto
     */
    public function setProducto(\bdBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \bdBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Proveedor_Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }
}
