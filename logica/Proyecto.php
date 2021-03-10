<?php

//require 'logica/Persona.php';
require 'persistencia/ProyectoDAO.php';
require_once 'persistencia/Conexion.php';

class Proyecto{

    private $id;
    private $titulo;
    private $descripccion;
    private $pdf;
    private $estado;
    private $tutor_idtutor;
    private $jurado_idjurado;
    private $proyectoDAO;

    function Proyecto($id="", $titulo="", $descripccion="", $pdf="", $estado="", $tutor_idtutor="", $jurado_idjurado=""){
        $this -> id = $id;
        $this -> titulo = $titulo;
        $this -> descripccion = $descripccion;
        $this -> pdf = $pdf;
        $this -> estado = $estado;
        $this -> tutor_idtutor = $tutor_idtutor;
        $this -> jurado_idjurado = $jurado_idjurado;
        $this -> conexion = new Conexion();
        $this -> proyectoDAO = new ProyectoDAO($id, $titulo, $descripccion, $pdf, $estado, $tutor_idtutor, $jurado_idjurado);
    }


    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> registrar());
        $this -> conexion -> cerrar();
    }

    function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> actualizar());
        $this -> conexion -> cerrar();
    }

    function actualizarEstado(){
        $this -> conexion -> abrir();
        //echo "</script> '".$this -> proyectoDAO -> actualizarEstado()."' <script>";
        $this -> conexion -> ejecutar($this -> proyectoDAO -> actualizarEstado());
        //echo "console.log('ya')";
        $this -> conexion -> cerrar();
    }

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> titulo = $resultado[1];
        $this -> descripccion = $resultado[2];
        $this -> pdf = $resultado[3];
        $this -> estado = $resultado[4];
        $this -> tutor_idtutor = $resultado[5];
        $this -> jurado_idjurado = $resultado[6];
        $this -> proyectoDAO = new ProyectoDAO($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6]);
        $this -> conexion -> cerrar();
    }

    function maxid(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> maxid());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> proyectoDAO = new ProyectoDAO($resultado[0]);
        $this -> conexion -> cerrar();
    }

    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarTodos());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = new Proyecto($registro[0], $registro[1], $registro[2], $registro[3]);
        }

        $this -> conexion -> cerrar();
        return $registros;
    }

    function getTutor(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarTutor());
        $resultado = $this -> conexion -> extraer();
        return $resultado[1];
        $this -> conexion -> cerrar();
    }

    function getJurado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarJurado());
        $resultado = $this -> conexion -> extraer();
        return $resultado[1];
        $this -> conexion -> cerrar();
    }

    function getEstudiantes(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> consultarEstudiantes());
        $registros = array();

        for($i=0; $i<$this->conexion->numFilas() ; $i++){
            $registro = $this->conexion->extraer();
            $registros[$i] = $registro[1];
        }
        $this -> conexion -> cerrar();
        $r="";
        (sizeof($registros)>1)?$r=$registros[0]." y ".$registros[1]:$r=$registros[0];
        return $r;
    }

    function asignar($estudianteid){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proyectoDAO -> asignar($estudianteid));
        $this -> conexion -> cerrar();
    }

    function getId(){
        return $this -> id;
    }
    function getTitulo(){
        return $this -> titulo;
    }
    function getDescripccion(){
        return $this -> descripccion;
    }
    function getPdf(){
        return $this -> pdf;
    }
    function getEstado(){
        $r="";
        ($this -> estado == 0)?$r="Creado por estudiante":"";
        ($this -> estado == 1)?$r="Asignado a tutor":"";
        ($this -> estado == 2)?$r="Revisado por tutor":"";
        ($this -> estado == 3)?$r="Asignado a jurado":"";
        ($this -> estado == 4)?$r="Aprobado por jurado":"";
        return $r;
    }
    function getEstadoId(){
        return $this -> estado;
    }
    function getTutorId(){
        return  $this -> tutor_idtutor;
    }
    function getJuradoId(){
        return $this -> jurado_idjurado;
    }
}

?>