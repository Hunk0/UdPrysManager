<?php

//require 'logica/Persona.php';
require 'persistencia/AdministradorDAO.php';
require_once 'persistencia/Conexion.php';

class Administrador extends Persona{
    private $conexion;
    private $administradorDAO;

    function Administrador($id="", $nombre="", $correo="", $clave=""){
        $this -> Persona($id, $nombre, $correo, $clave);
        $this -> conexion = new Conexion();
        $this -> administradorDAO = new AdministradorDAO($id, $nombre, $correo, $clave);
    }

    function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> autenticar());
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> conexion -> cerrar();
            return true;
        }else{
            $this -> conexion -> cerrar();
            return false;
        }
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> usuario = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> conexion -> cerrar();
    }
}

?>