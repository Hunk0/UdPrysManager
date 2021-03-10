<?php

class TutorDAO{
    private $id;
    private $profesor_id;
    private $nombre;

    function TutorDAO($id="",  $profesor_id="", $nombre=""){
        $this -> id = $id;
        $this -> profesor_id = $profesor_id;
        $this -> nombre = $nombre;
    }

    function consultar(){
            return "SELECT tutor.idtutor, tutor.profesor_idprofesor, profesor.nombre
                    FROM tutor
                    INNER JOIN profesor
                    ON (profesor.idprofesor=tutor.profesor_idprofesor && tutor.idtutor="."'".$this -> id."')";
    }

    function consultarTodos(){
        return "SELECT tutor.idtutor, tutor.profesor_idprofesor, profesor.nombre
                FROM tutor
                INNER JOIN profesor
                ON (profesor.idprofesor=tutor.profesor_idprofesor)";
    }

    function registrar(){
        return "INSERT INTO tutor
                (profesor_idprofesor)
                VALUES (". $this -> profesor_id .")";
    }

    function proyectosAsignados(){
        return "SELECT proyecto.idproyecto
                FROM proyecto
                WHERE proyecto.tutor_idtutor = (SELECT tutor.idtutor
                                            FROM tutor
                                            WHERE tutor.profesor_idprofesor = ".$this->profesor_id.")";
    }
}

?>