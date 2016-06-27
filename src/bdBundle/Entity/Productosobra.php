<?php

namespace bdBundle\Entity;

/**
 * Productosobra
 */
class Productosobra
{
    /**
     * @var integer
     */
    private $id;

    /**
    * @var string
    */
    private $proveedor;

    /**
     * @var integer
     */
    private $albaran;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $und;

    /**
     * @var float
     */
    private $precio;

    /**
     * @var float
     */
    private $oferta;

    /**
     * @var \bdBundle\Entity\Obra
     */
    private $obra;

    /**
     *@var \bdBundle\Entity\Producto
     */
    private $codprod;

    /**
     * @var \bdBundle\Entity\Prefijo
     */
    private $prefijo;


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
     * @return Productosobra
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
     * Set und
     *
     * @param integer $und
     *
     * @return Productosobra
     */
    public function setUnd($und)
    {
        $this->und = $und;

        return $this;
    }

    /**
     * Get und
     *
     * @return integer
     */
    public function getUnd()
    {
        return $this->und;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Productosobra
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
     * Set obra
     *
     * @param \bdBundle\Entity\Obra $obra
     *
     * @return Productosobra
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
     * Set codprod
     *
     * @param \bdBundle\Entity\Producto $codprod
     *
     * @return Productosobra
     */
    public function setCodprod(\bdBundle\Entity\Producto $codprod = null)
    {
        $this->codprod = $codprod;

        return $this;
    }

    /**
     * Get codprod
     *
     * @return \bdBundle\Entity\Producto
     */
    public function getCodprod()
    {
        return $this->codprod;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return Productosobra
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
     * Set albaran
     *
     * @param integer $albaran
     *
     * @return Productosobra
     */
    public function setAlbaran($albaran)
    {
        $this->albaran = $albaran;

        return $this;
    }

    /**
     * Get albaran
     *
     * @return integer
     */
    public function getAlbaran()
    {
        return $this->albaran;
    }

    /**
     * Set prefijo
     *
     * @param \bdBundle\Entity\Prefijo $prefijo
     *
     * @return Productosobra
     */
    public function setPrefijo(\bdBundle\Entity\Prefijo $prefijo = null)
    {
        $this->prefijo = $prefijo;

        return $this;
    }

    /**
     * Get prefijo
     *
     * @return \bdBundle\Entity\Prefijo
     */
    public function getPrefijo()
    {
        return $this->prefijo;
    }

    /**
     * Set oferta
     *
     * @param float $oferta
     *
     * @return Productosobra
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return float
     */
    public function getOferta()
    {
        return $this->oferta;
    }
}
