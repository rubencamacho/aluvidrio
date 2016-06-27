<?php

namespace bdBundle\Entity;

/**
 * Fecha
 */
class Fecha
{
    /**
     * @var integer
     */
    private $id;
    
	/**
     * @var date
    */
    private $dia_inicio;

    /**
     * @var date
    */
    private $dia_fin;

    private $total;

    private $operario;

    


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
     * Set diaInicio
     *
     * @param \DateTime $diaInicio
     *
     * @return Fecha
     */
    public function setDiaInicio($diaInicio)
    {
        $this->dia_inicio = $diaInicio;

        return $this;
    }

    /**
     * Get diaInicio
     *
     * @return \DateTime
     */
    public function getDiaInicio()
    {
        return $this->dia_inicio;
    }

    /**
     * Set diaFin
     *
     * @param \DateTime $diaFin
     *
     * @return Fecha
     */
    public function setDiaFin($diaFin)
    {
        $this->dia_fin = $diaFin;

        return $this;
    }

    /**
     * Get diaFin
     *
     * @return \DateTime
     */
    public function getDiaFin()
    {
        return $this->dia_fin;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Fecha
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set operario
     *
     * @param string $operario
     *
     * @return Fecha
     */
    public function setOperario($operario)
    {
        $this->operario = $operario;

        return $this;
    }

    /**
     * Get operario
     *
     * @return string
     */
    public function getOperario()
    {
        return $this->operario;
    }
}
