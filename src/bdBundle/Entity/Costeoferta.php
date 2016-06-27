<?php

namespace bdBundle\Entity;

/**
 * Costeoferta
 */
class Costeoferta
{
    /**
     * @var integer
     */
    private $id;
   
    /**
     * @var string
     */
    private $codoferta;

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
     * @var \bdBundle\Entity\Obra
     */
    private $obra;

    /**
     * @var \bdBundle\Entity\Producto
     */
    private $producto;

    /**
     * @var \bdBundle\Entity\Prefijo
     */
    private $prefijo;

    
    public function __toString() {
        return (string) $this->descripcion;
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
     * @return Costeoferta
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
     * @return Costeoferta
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
     * @return Costeoferta
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
     * @return Costeoferta
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
     * Set codoferta
     *
     * @param string $codoferta
     *
     * @return Costeoferta
     */
    public function setCodoferta($codoferta)
    {
        $this->codoferta = $codoferta;

        return $this;
    }

    /**
     * Get codoferta
     *
     * @return string
     */
    public function getCodoferta()
    {
        return $this->codoferta;
    }

    /**
     * Set producto
     *
     * @param \bdBundle\Entity\Producto $producto
     *
     * @return Costeoferta
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
     * Set prefijo
     *
     * @param \bdBundle\Entity\Prefijo $prefijo
     *
     * @return Costeoferta
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
}
