<?php

class Persona {
    protected $id;
    protected $nombre;
    protected $correo;
    protected $clave;

    function Persona($id="", $nombre="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    function getId(){
        return $this -> id;
    }

    function getNombre(){
        return $this -> nombre;
    }

    function getCorreo(){
        return $this -> correo;
    }
        
}

?>