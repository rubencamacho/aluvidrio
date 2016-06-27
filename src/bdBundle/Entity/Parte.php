<?php

namespace bdBundle\Entity;

/**
 * Parte
 */
class Parte
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $operario;

    /**
     * @var date
    */
    private $dia;

    /**
     * @var time
     */
    private $hora_inicio_manana;

    /**
     * @var time
     */
    private $hora_fin_manana;
   

    /**
     * @var time
     */
    private $hora_inicio_tarde;

    /**
     * @var time
     */
    private $hora_fin_tarde;

    /**
     * @var float
     */
    private $total;

    /**
     * @var text
     */
    private $observaciones;

    /**
     * @var \bdBundle\Entity\Obra
     */
    private $obra;

    public function __toString() {
        return (string) $this->operario;
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
     * Set operario
     *
     * @param string $operario
     *
     * @return Parte
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

    /**
     * Set horaInicioManana
     *
     * @param \DateTime $horaInicioManana
     *
     * @return Parte
     */
    public function setHoraInicioManana($horaInicioManana)
    {
        $this->hora_inicio_manana = $horaInicioManana;

        return $this;
    }

    /**
     * Get horaInicioManana
     *
     * @return \DateTime
     */
    public function getHoraInicioManana()
    {
        return $this->hora_inicio_manana;
    }

    /**
     * Set horaFinManana
     *
     * @param \DateTime $horaFinManana
     *
     * @return Parte
     */
    public function setHoraFinManana($horaFinManana)
    {
        $this->hora_fin_manana = $horaFinManana;

        return $this;
    }

    /**
     * Get horaFinManana
     *
     * @return \DateTime
     */
    public function getHoraFinManana()
    {
        return $this->hora_fin_manana;
    }

    /**
     * Set horaInicioTarde
     *
     * @param \DateTime $horaInicioTarde
     *
     * @return Parte
     */
    public function setHoraInicioTarde($horaInicioTarde)
    {
        $this->hora_inicio_tarde = $horaInicioTarde;

        return $this;
    }

    /**
     * Get horaInicioTarde
     *
     * @return \DateTime
     */
    public function getHoraInicioTarde()
    {
        return $this->hora_inicio_tarde;
    }

    /**
     * Set horaFinTarde
     *
     * @param \DateTime $horaFinTarde
     *
     * @return Parte
     */
    public function setHoraFinTarde($horaFinTarde)
    {
        $this->hora_fin_tarde = $horaFinTarde;

        return $this;
    }

    /**
     * Get horaFinTarde
     *
     * @return \DateTime
     */
    public function getHoraFinTarde()
    {
        return $this->hora_fin_tarde;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Parte
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set dia
     *
     * @param \DateTime $dia
     *
     * @return Parte
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return \DateTime
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set obra
     *
     * @param \bdBundle\Entity\Obra $obra
     *
     * @return Parte
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
     * Set lugarManana
     *
     * @param string $lugarManana
     *
     * @return Parte
     */
    public function setLugarManana($lugarManana)
    {
        $this->lugar_manana = $lugarManana;

        return $this;
    }

    /**
     * Get lugarManana
     *
     * @return string
     */
    public function getLugarManana()
    {
        return $this->lugar_manana;
    }

    /**
     * Set lugarTarde
     *
     * @param string $lugarTarde
     *
     * @return Parte
     */
    public function setLugarTarde($lugarTarde)
    {
        $this->lugar_tarde = $lugarTarde;

        return $this;
    }

    /**
     * Get lugarTarde
     *
     * @return string
     */
    public function getLugarTarde()
    {
        return $this->lugar_tarde;
    }

    /**
     * Set mantenimiento
     *
     * @param boolean $mantenimiento
     *
     * @return Parte
     */
    public function setMantenimiento($mantenimiento)
    {
        $this->mantenimiento = $mantenimiento;

        return $this;
    }

    /**
     * Get mantenimiento
     *
     * @return boolean
     */
    public function getMantenimiento()
    {
        return $this->mantenimiento;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Parte
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
}
