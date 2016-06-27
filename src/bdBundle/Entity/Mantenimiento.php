<?php

namespace bdBundle\Entity;

/**
 * Mantenimiento
 */
class Mantenimiento
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
     * @return Mantenimiento
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
     * Set dia
     *
     * @param \DateTime $dia
     *
     * @return Mantenimiento
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
     * Set horaInicioManana
     *
     * @param \DateTime $horaInicioManana
     *
     * @return Mantenimiento
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
     * @return Mantenimiento
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
     * @return Mantenimiento
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
     * @return Mantenimiento
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
     * @return Mantenimiento
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
     * Set total
     *
     * @param integer $total
     *
     * @return Mantenimiento
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
