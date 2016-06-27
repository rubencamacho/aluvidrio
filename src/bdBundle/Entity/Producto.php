<?php

namespace bdBundle\Entity;

/**
 * Producto
 */
class Producto
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
     *@var string
     */
    private $codprod;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var float
     */
    private $precio;

    protected $proveedores;

    public function __construct() {
        $this->proveedores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return (string) $this->codprod;
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
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



    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Producto
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



    /**
     * Set codprod
     *
     * @param string $codprod
     *
     * @return Producto
     */
    public function setCodprod($codprod)
    {
        $this->codprod = $codprod;

        return $this;
    }

    /**
     * Get codprod
     *
     * @return string
     */
    public function getCodprod()
    {
        return $this->codprod;
    }

    public function add(Proveedor $proveedor)
    {
        $this->proveedores[] = $proveedor;
    }

    /**
     * Set prefijo
     *
     * @param string $prefijo
     *
     * @return Producto
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
     * Add proveedore
     *
     * @param \bdBundle\Entity\Proveedor $proveedore
     *
     * @return Producto
     */
    public function addProveedore(\bdBundle\Entity\Proveedor $proveedore)
    {
        $this->proveedores[] = $proveedore;

        return $this;
    }

    /**
     * Remove proveedore
     *
     * @param \bdBundle\Entity\Proveedor $proveedore
     */
    public function removeProveedore(\bdBundle\Entity\Proveedor $proveedore)
    {
        $this->proveedores->removeElement($proveedore);
    }

    /**
     * Get proveedores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProveedores()
    {
        return $this->proveedores;
    }
}
