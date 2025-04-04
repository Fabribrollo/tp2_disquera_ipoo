<?php
include_once '1Persona.php';
include_once '2disquera.php';

echo "Ingrese el horario de atencion de la disquera: (Formato 24hs)\n";
echo "Hora de Apertura: ";
$hora_desde = trim(fgets(STDIN));
echo "Minuto de Apertura: ";
$minuto_desde = trim(fgets(STDIN));

echo "Hora de cierre: ";
$hora_hasta = trim(fgets(STDIN));
echo "Minuto de cierre: ";
$minuto_hasta = trim(fgets(STDIN));

$horario_desde = ["horas" => $hora_desde, "minutos" => $minuto_desde];
$horario_hasta = ["horas" => $hora_hasta, "minutos" => $minuto_hasta];

echo "Ingrese la direccion de la disquera: ";
$direccion = trim(fgets(STDIN));

echo "Ingrese la información del dueño: \n";
$dueño = solicitarPersona();

$disquera = new Disquera($horario_desde, $horario_hasta, $direccion, $dueño);

do {
    $estadoDisquera = $disquera->getEstado() ? "Abierto" : "Cerrado";
    echo "\n
    -----------------------------------------
    Estado disquera: " . $estadoDisquera . "
    Menu:     
    (1).- Abrir la disquera 
    (2).- Cerrar la disquera
    (3).- Cambiar horario de atención
    (4).- Salir
    -----------------------------------------\n";
    $respuesta = trim(fgets(STDIN));

    if($respuesta == 1){
        // verifica si la disquera ya esta abierta
        if($disquera->getEstado() == false){
        echo "Ingrese el horario para abrir la disquera: " . "(" . $hora_desde . ":" . $minuto_desde . " - " . $hora_hasta . ":" . $minuto_hasta . ")\n";
        echo "Ingrese la hora: ";
        $hora = trim(fgets(STDIN));

        echo "Ingrese los minutos: ";
        $minutos = trim(fgets(STDIN));

        echo $disquera->abrirDisquera($hora, $minutos) ? "La disquera fue abierta!" : "El horario establecido no está dentro del horario de atencion, no fue posible abrir la disquera. \n";
        }else{
            echo "La disquera ya esta abierta!";
        }
    }

    if($respuesta == 2){
        // verifica si la disquera ya esta cerrada
        if($disquera->getEstado() == true){
        echo "Ingrese el horario para cerrar la disquera: " . "(" . $hora_desde . ":" . $minuto_desde . " - " . $hora_hasta . ":" . $minuto_hasta . ")\n";
        echo "Ingrese la hora: ";
        $hora = trim(fgets(STDIN));

        echo "Ingrese los minutos: ";
        $minutos = trim(fgets(STDIN));

        echo $disquera->cerrarDisquera($hora, $minutos) ? "La disquera fue cerrada!" : "El horario establecido está dentro del horario de atencion, no fue posible cerrar la disquera. \n";
        }else{
            echo "La disquera ya esta cerrada!";
        }
    }


    if($respuesta == 3){
        //para cambiar el horario de atencion, antes cierra el negocio

        $disquera->getEstado(false);
        echo "Ingrese el nuevo horario de atencion: (Formato 24hs)\n";
        echo "Hora de apertura: ";
        $hora_desde = trim(fgets(STDIN));
        echo "Minuto de Apertura: ";
        $minuto_desde = trim(fgets(STDIN));

        echo "Hora de cierre: ";
        $hora_hasta = trim(fgets(STDIN));
        echo "Minuto de cierre: ";
        $minuto_hasta = trim(fgets(STDIN));

        $nueva_hora_desde = ["horas" => $hora_desde, "minutos" => $minuto_desde];
        $nueva_hora_hasta = ["horas" => $hora_hasta, "minutos" => $minuto_desde];

        $disquera->setHoraDesde($nueva_hora_desde);
        $disquera->setHoraHasta($nueva_hora_hasta);

        echo "El horario de atención fue modificado a: " . $hora_desde . ":" . $minuto_desde . " - " . $hora_hasta . ":" . $minuto_hasta;

    }

} while ($respuesta != 4);





?>