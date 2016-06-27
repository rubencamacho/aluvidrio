<?php

namespace bdBundle\Entity;

/**
 * Proveedor
 */
class Proveedor
{
    /**
     * @var integer
     */
    private $id;

    /**
     *@var string
     */
    private $codprov;

    /**
     * @var string
     */
    private $proveedor;


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
     * @return Proveedor
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
     * @return Proveedor
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

    public function add(Producto $producto)
    {
        $this->productos[] = $producto;
    }


    /**
     * Set producto
     *
     * @param \bdBundle\Entity\Producto $producto
     *
     * @return Proveedor
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
}
