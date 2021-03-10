<?php

class JuradoDAO{
    private $id;
    private $profesor_id;
    private $nombre;

    function JuradoDAO($id="",  $profesor_id="", $nombre=""){
        $this -> id = $id;
        $this -> profesor_id = $profesor_id;
        $this -> nombre = $nombre;
    }

    function consultar(){
            return "SELECT jurado.idjurado, jurado.profesor_idprofesor, profesor.nombre
                    FROM jurado
                    INNER JOIN profesor
                    ON (profesor.idprofesor=jurado.profesor_idprofesor && jurado.idjurado="."'".$this -> id."')";
    }

    function consultarTodos(){
        return "SELECT jurado.idjurado, jurado.profesor_idprofesor, profesor.nombre
                FROM jurado
                INNER JOIN profesor
                ON (profesor.idprofesor=jurado.profesor_idprofesor )";
    }

    function registrar(){
        return "INSERT INTO jurado
                (profesor_idprofesor)
                VALUES (". $this -> profesor_id .")";
    }

    function proyectosAsignados(){
        return "SELECT proyecto.idproyecto
                FROM proyecto
                WHERE proyecto.jurado_idjurado = (SELECT jurado.idjurado
                                            FROM jurado
                                            WHERE jurado.profesor_idprofesor = ".$this->profesor_id.")";
    }
}

?>