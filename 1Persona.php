<?php
class Persona {
    private $nombre;
    private $apellido;
    private $tipoDocumento;
    private $numeroDocumento;

    public function __construct($nombre, $apellido, $tipoDocumento, $numeroDocumento)
    {
        if(is_numeric($numeroDocumento)){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
    }else{
        throw new ErrorException("Los datos ingresados son incorrectos");
    };
}

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }
    
    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }

    public function setNombre($setNombre){
        $this->nombre = $setNombre;
    }

    public function setApellido($setApellido){
        $this->apellido = $setApellido;
    }

    public function setTipoDocumento($setTipoDocumento){
        $this->tipoDocumento = $setTipoDocumento;
    }

    public function setNumeroDocumento($setNumeroDocumento){
        $this->numeroDocumento = $setNumeroDocumento;
    }

    public function __toString()
    {
        return " 
        Nombre: " . $this->nombre . "\n" .  
        "Apellido: " . $this->apellido . "\n" .  
        "Tipo de documento: " . $this->tipoDocumento . "\n" .  
        "Número de documento: " . $this->numeroDocumento . "\n";
    }


}
function solicitarPersona(){
    echo "Ingrese su nombre: ";
    $nombre = trim(fgets(STDIN));

    echo "Ingrese su apellido: ";
    $apellido = trim(fgets(STDIN));

    echo "Ingrese su tipo de documento: (CUIT, CUIL, DNI)";
    $tipoDocumento = trim(fgets(STDIN));
    
    echo "Ingrese su numero documento: ";
    $numeroDocumento = trim(fgets(STDIN));

    return new Persona($nombre, $apellido, $tipoDocumento, $numeroDocumento);
}


;


?>