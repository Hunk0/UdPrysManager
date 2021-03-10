<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

$estudiante = new Estudiante();
$estudiantes = $estudiante->consultarTodos();

include 'presentacion/mnuAdministrador.php';
?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-info text-white" >Registro de Estudiantes</div>
				<div class="card-body">
					<?php echo "<tr><td colspan='9'>" . count($estudiantes) . " registros encontrados</td></tr>" ?>
					<br/>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
                                <th scope="col">Codigo</th>
								<th scope="col">Nombre</th>
                                <th scope="col-lg">Proyectos</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($estudiantes as $e) {
                                echo "<tr>";
								echo "<td>" . $e->getCodigo() . "</td>";
                                echo "<td>" . $e->getNombre() . "</td>";
								
								$proyectos = $e->consultarProyectos();
								echo "<td>";
										foreach ($proyectos as $p){
											echo "<a class='fas fa-file-pdf' href='index.php?pid=" . base64_encode("presentacion/consultarProyecto.php") . "&idDoc=".$p->getId()."' data-toggle='tooltip' data-placement='top' title='".$p->getTitulo()."' style='padding: .0.1rem 0.1rem; color : #17a2b8 !important;' > </a>";
										}
								echo"</td>";                                
								echo "</tr>";
							
							}							
						?>
						</tbody>
					</table>
					<div class="row">
					<div class="col-sm-12">
						<div class="text-center">
						<a class="btn btn-info" href='index.php?pid=<?php echo base64_encode("presentacion/estudiante/registrarEstudiante.php")?>'>Agregar Nuevo</a>
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
