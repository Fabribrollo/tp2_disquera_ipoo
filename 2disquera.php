<?php

class Disquera
{
    private $hora_desde;
    private $hora_hasta;
    private $estado;
    private $direccion;
    private $dueño;

    public function __construct($hora_desde, $hora_hasta, $direccion, $dueño)
    {
        if (
            /// se asegura de que las horas vayan de 00 a 23 y que los minutos vayan de 00 a 59
            $hora_desde["horas"] >= 00 && $hora_desde["horas"] <= 23 && $hora_desde["minutos"] >= 00 && $hora_desde["minutos"] <= 59 &&
            $hora_hasta["horas"] >= 00 && $hora_hasta["horas"] <= 23 && $hora_hasta["minutos"] >= 00 && $hora_hasta["minutos"] <= 59 &&
            /// se asegura de que el horario 'desde' sea menor al de 'hasta'.
            $hora_desde["horas"] <= $hora_hasta["horas"] && $hora_desde["minutos"] <= $hora_hasta["minutos"] &&
            /// se asegura de que los valores sean numericos, y que estado sea booleano
            is_numeric($hora_desde["horas"]) && is_numeric($hora_desde["minutos"]) &&
            is_numeric($hora_hasta["horas"]) && is_numeric($hora_hasta["minutos"])
        ) {


            ///inicializacion de atributos
            $this->hora_desde = $hora_desde;
            $this->hora_hasta = $hora_hasta;
            ///la disquera se inicializa cerrada.
            $this->estado = false;
            $this->direccion = $direccion;
            $this->dueño = $dueño;
        } else {
            throw new ErrorException("Los datos ingresados son incorrectos");
        }
    }



    public function getHoraDesde()
    {
        return $this->hora_desde;
    }

    public function setHoraDesde($hora_desde)
    {
        $this->hora_desde = $hora_desde;
    }

    public function getHoraHasta()
    {
        return $this->hora_hasta;
    }

    public function setHoraHasta($hora_hasta)
    {
        $this->hora_hasta = $hora_hasta;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getDueño()
    {
        return $this->dueño;
    }

    public function setDueño($dueño)
    {
        $this->dueño = $dueño;
    }

    public function dentroHorarioAtencion($hora, $minutos)
    {
        $horaDesde = $this->hora_desde["horas"];
        $horaHasta = $this->hora_hasta["horas"];
        $minutosDesde = $this->hora_desde["minutos"];
        $minutosHasta = $this->hora_hasta["minutos"];


        if (
            ($hora > $horaDesde || ($hora == $horaDesde && $minutos >= $minutosDesde)) &&
            ($hora < $horaHasta || ($hora == $horaHasta && $minutos <= $minutosHasta))
        ) {
            $dentroHorarioAtencion = true;
        } else {
            $dentroHorarioAtencion = false;
        }
        return $dentroHorarioAtencion;
    }

    public function abrirDisquera($hora, $minutos)
    {   ///utiliza el metodo anterior y pregunta si es verdadero que el horario por parametro esta dentro del horario de atencion, si es correcto
        // abre la disquera
        $dentroHorarioAtencion = $this->dentroHorarioAtencion($hora, $minutos);
        if ($dentroHorarioAtencion == true) {
            $this->setEstado(true);
            $respuesta = true;
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }

    public function cerrarDisquera($hora, $minutos)
    {
        $dentroHorarioAtencion = $this->dentroHorarioAtencion($hora, $minutos);
        if ($dentroHorarioAtencion == false) {
            $this->setEstado(false);
            $respuesta = true;
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }

    public function __toString()
    {
        return "Disquera: \n" .
            "Hora de apertura: " . $this->hora_desde . "\n" .
            "Hora de cierre: " . $this->hora_hasta . "\n" .
            "Estado: " . $this->estado . "\n" .
            "Dirección: " . $this->direccion . "\n" .
            "Dueño: " . $this->dueño . "\n";
    }
}
