<script type="text/javascript">
$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<?php
require 'logica/Persona.php';
require 'logica/Administrador.php';
require 'logica/Estudiante.php';
require 'logica/Profesor.php';
require 'logica/Proyecto.php';
require 'logica/Tutor.php';
require 'logica/Jurado.php';
$pid = base64_decode($_GET["pid"]);
include $pid;
?>