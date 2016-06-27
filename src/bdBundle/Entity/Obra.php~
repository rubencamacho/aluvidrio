<?php

namespace bdBundle\Entity;

/**
 * Obra
 */
class Obra
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $obra;

    /**
     * @var string
     */
    private $cliente;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var boolean
     */
    private $presupuesto;

    /**
     * @var boolean
     */
    private $oferta;
    
    protected $products;

    public function __construct() {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return (string) $this->obra;
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
     * Set cliente
     *
     * @param string $cliente
     *
     * @return Obra
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Obra
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Obra
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set costereal
     *
     * @param float $costereal
     *
     * @return Obra
     */
    public function setCosteReal($costereal)
    {
        $this->costereal = $costereal;

        return $this;
    }

    /**
     * Get estado
     *
     * @return float
     */
    public function getCosteReal()
    {
        return $this->costereal;
    }

    
    
    public function getproducts(){
        return $this->products;
    }

    /**
     * Add product
     *
     * @param \bdBundle\Entity\Producto $product
     *
     * @return Obra
     */
    public function addProduct(\bdBundle\Entity\Producto $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \bdBundle\Entity\Producto $product
     */
    public function removeProduct(\bdBundle\Entity\Producto $product)
    {
        $this->products->removeElement($product);
    }



    /**
     * Set presupuesto
     *
     * @param boolean $presupuesto
     *
     * @return Obra
     */
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return boolean
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    /**
     * Set oferta
     *
     * @param boolean $oferta
     *
     * @return Obra
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return boolean
     */
    public function getOferta()
    {
        return $this->oferta;
    }



    /**
     * Set obra
     *
     * @param string $obra
     *
     * @return Obra
     */
    public function setObra($obra)
    {
        $this->obra = $obra;

        return $this;
    }

    /**
     * Get obra
     *
     * @return string
     */
    public function getObra()
    {
        return $this->obra;
    }

}
