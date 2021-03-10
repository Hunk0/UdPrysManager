<?php

//require 'logica/Persona.php';
require 'persistencia/tutorDAO.php';
require_once 'persistencia/Conexion.php';

class Tutor {
    private $id;
    private $profesor_id;
    private $nombre;
    private $conexion;
    private $tutorDAO;

    function Tutor($id="",$profesor_id="", $nombre=""){
        $this -> id = $id;
        $this -> profesor_id = $profesor_id;
        $this -> nombre = $nombre;
        $this -> conexion = new Conexion();
        $this -> tutorDAO = new TutorDAO($id, $profesor_id, $nombre);
    }

    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tutorDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tutorDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> profesor_id = $resultado[1];
        $this -> nombre = $resultado[2];
        $this -> conexion -> cerrar();
    }

    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tutorDAO -> consultarTodos());
        $proyectos = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $proyecto = $this->conexion->extraer();
            $proyectos[$i] = new Tutor($proyecto[0], $proyecto[1], $proyecto[2]);
        }

        $this -> conexion -> cerrar();
        return $proyectos;
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
        $this -> conexion -> ejecutar($this -> tutorDAO -> proyectosAsignados());
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