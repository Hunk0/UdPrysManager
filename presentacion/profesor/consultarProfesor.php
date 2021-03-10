<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

$profesor = new profesor();
$profesores = $profesor->consultarTodos();

include 'presentacion/mnuAdministrador.php';
?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-primary text-white" >Registro de Docentes</div>
				<div class="card-body">
					<?php echo "<tr><td colspan='9'>" . count($profesores) . " registros encontrados</td></tr>" ?>
					<br/>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">Id.</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Cant. Proyectos</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($profesores as $p) {
                                echo "<tr>";
								echo "<td>" . $p->getId() . "</td>";
								echo "<td>" . $p->getNombre() . "</td>";
								echo "<td>" . $p->getCorreo() . "</td>";
                                echo "<td> </td>";
                                
								/*							
								echo "<td>" . "
											  <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/pelicula/editarPelicula.php") . "&idPelicula=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Editar Informacion'> </a>
											  <a href='modalPelicula.php?idPelicula=" . $p->getId() . "' data-toggle='modal' data-target='#modalPaciente' ><span class='fas fa-eye' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Ver Detalles' ></span> </a>
                                    </td>";
                                */
								echo "</tr>";
							
							}							
						?>
						</tbody>
					</table>
					<div class="row">
					<div class="col-sm-12">
						<div class="text-center">
						<a class="btn btn-primary" href='index.php?pid=<?php echo base64_encode("presentacion/profesor/registrarProfesor.php")?>'>Agregar Nuevo</a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
