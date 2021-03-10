<?php

//require 'logica/Persona.php';
require 'persistencia/EstudianteDAO.php';
require_once 'persistencia/Conexion.php';

class Estudiante extends Persona{

    private $codigo;
    private $conexion;
    private $estudianteDAO;

    function Estudiante($id="", $nombre="", $codigo="" ,$correo="", $clave=""){
        $this -> Persona($id, $nombre, $correo, $clave);
        $this -> codigo= $codigo;
        $this -> conexion = new Conexion();
        $this -> estudianteDAO = new EstudianteDAO($id, $nombre, $codigo, $correo, $clave);
    }

    function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> autenticar());
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

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> codigo = $resultado[2];
        $this -> correo = $resultado[3];
        $this -> conexion -> cerrar();
    }

    function consultarProyectos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultarProyectos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Proyecto($registro[0]);            
            $registros[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Estudiante($registro[0], $registro[1], $registro[2], $registro[3]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> estudianteDAO -> existeCorreo());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;            
        }
    }

    function getCodigo(){
        return $this -> codigo;
    }

    function getId(){
        return $this -> id;
    }

    function getNombre(){
        return $this -> nombre;
    }
}

?>