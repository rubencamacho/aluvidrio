<?php

namespace bdBundle\Entity;

/**
 * Ofertas
 */
class Oferta
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $costeoferta;

    /**
     * @var \bdBundle\Entity\Obra
     */
    private $obra;
    /**
     * @var \bdBundle\Entity\Costeoferta
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
     * Set costeoferta
     *
     * @param float $costeoferta
     *
     * @return Oferta
     */
    public function setCosteoferta($costeoferta)
    {
        $this->costeoferta = $costeoferta;

        return $this;
    }

    /**
     * Get costeoferta
     *
     * @return float
     */
    public function getCosteoferta()
    {
        return $this->costeoferta;
    }

    /**
     * Set obra
     *
     * @param \bdBundle\Entity\Obra $obra
     *
     * @return Oferta
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
     * @param \bdBundle\Entity\Costeoferta $producto
     *
     * @return Oferta
     */
    public function setProducto(\bdBundle\Entity\Costeoferta $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \bdBundle\Entity\Costeoferta
     */
    public function getProducto()
    {
        return $this->producto;
    }
}
