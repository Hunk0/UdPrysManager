<?php

//require 'logica/Persona.php';
require 'persistencia/ProfesorDAO.php';
require_once 'persistencia/Conexion.php';

class Profesor extends Persona{
    private $conexion;
    private $profesorDAO;

    function Profesor($id="", $nombre="", $correo="", $clave=""){
        $this -> Persona($id, $nombre, $correo, $clave);
        $this -> conexion = new Conexion();
        $this -> profesorDAO = new ProfesorDAO($id, $nombre, $correo, $clave);
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function maxid(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> maxid());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> profesorDAO = new ProfesorDAO($resultado[0]);
        $this -> conexion -> cerrar();
        return $this -> id;
    }

    function autenticar(){
        $this -> conexion -> abrir();
        echo $this -> profesorDAO -> autenticar();
        $this -> conexion -> ejecutar($this -> profesorDAO -> autenticar());
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
        $this -> conexion -> ejecutar($this -> profesorDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> conexion -> cerrar();
    }

    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Profesor($registro[0], $registro[1], $registro[2]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> profesorDAO -> existeCorreo());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;            
        }
    }
}

?>