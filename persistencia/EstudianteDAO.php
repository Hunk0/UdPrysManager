<?php

class EstudianteDAO{
    private $id;
    private $nombre;
    private $codigo;
    private $correo;
    private $clave;

    function EstudianteDAO($id="", $nombre="",$codigo="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> codigo = $codigo;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    function registrar(){
        return "insert into estudiante 
                (nombre, codigo,	mail,	pass)
                values ('" . $this->nombre . "', '" . $this->codigo . "', '" . $this->correo . "',  md5('" . $this->clave . "'))";
    }


    function autenticar(){
        return "select idestudiante from estudiante
                where mail = '" . $this -> correo . "' and pass= md5('" . $this -> clave . "')";
    }

    function consultar(){
        return "select idestudiante, nombre, codigo, mail from estudiante 
                       where idestudiante = '" . $this -> id . "'";
    }

    function consultarTodos(){
        return "select idestudiante, nombre, codigo, mail
                from estudiante";
    }

    function consultarProyectos(){
        return "SELECT proyecto_idproyecto
                FROM estudiante_has_proyecto
                WHERE estudiante_idestudiante =".$this -> id;
    }

    function existeCorreoOLD(){
        return "select idestudiante from estudiante
                where mail = '" . $this->correo . "'";
    }

    function existeCorreo(){
        return "SELECT estudiante.idestudiante, profesor.idprofesor, administrador.idadministrador 
                FROM estudiante
                INNER JOIN profesor, administrador
                WHERE (estudiante.mail = '" . $this->correo . "' OR profesor.mail = '" . $this->correo . "' OR administrador.mail = '" . $this->correo . "')";
    }

}

?>