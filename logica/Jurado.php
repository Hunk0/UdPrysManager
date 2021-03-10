<?php

//require 'logica/Persona.php';
require 'persistencia/juradoDAO.php';
require_once 'persistencia/Conexion.php';

class Jurado {
    private $id;
    private $profesor_id;
    private $nombre;
    private $conexion;
    private $juradoDAO;

    function Jurado($id="",$profesor_id="", $nombre=""){
        $this -> id = $id;
        $this -> profesor_id = $profesor_id;
        $this -> nombre = $nombre;
        $this -> conexion = new Conexion();
        $this -> juradoDAO = new JuradoDAO($id, $profesor_id, $nombre);
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> juradoDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> juradoDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> profesor_id = $resultado[1];
        $this -> nombre = $resultado[2];
        $this -> conexion -> cerrar();
    }

    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> juradoDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Jurado($registro[0], $registro[1], $registro[2]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function getId(){
        return $this -> id;
    }

    function getProfesorId(){
        return $this -> profesor_id;
    }

    function getNombre(){
        return $this -> nombre;
    }

    function getProyectos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> juradoDAO -> proyectosAsignados());
        $proyectos = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $proyecto = $this->conexion->extraer();
            $proyectos[$i] = new Proyecto($proyecto[0], "", "", "", "", "", "");
            $proyectos[$i] -> consultar();
        }

        $this -> conexion -> cerrar();
        return $proyectos;
    }
}

?>