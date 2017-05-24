<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>

<?php

	session_start();
	$cedulaAprobador=$_SESSION['idUsuario'];

	include("../../controladora/ctrListaSeguimientos.php");
	$control=new ctrListaSeguimientos;
	$lista=$control->obtenerSeguimientosAprobador($cedulaAprobador);

 ?>

 <script>	
		window.onload=ocultarBarra();
		$( document ).ready(function(){
	   	$('select').material_select();
	   	});
	</script>

		<div class="row">
			<?php  
				if($lista!=null){
			?>

			<h2>Lista seguimientos</h2>
			<div class="col s12 m12 l12 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered">
						<thead>
							<tr>
								<th>Actividad</th>
								<th>Estado del seguimiento</th>
								<th>Comentario del aprobador</th>
								<th>Opcion 1</th>
								<th>Opcion 2</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							
								foreach ($lista as $seguimiento){

										
									
									echo "<tr>
											<td>".$seguimiento->getActividadTratamiento()."</td>
									";

											
											if($seguimiento->getEstadoSeguimiento() == null){
												echo "
												
													<td>Aun no se ha realizado la aprobacion</td>
											
												";

											} else if($seguimiento->getEstadoSeguimiento()==1) {
												echo "
												
													<td>Aprobado</td>
											
												";
											}else if($seguimiento->getEstadoSeguimiento()==0){
												echo "
												
													<td>Reprobado</td>
											
												";
											}


											if($seguimiento->getComentarioAprobador() == null){
												echo "
												
													<td>Aun no se ha realizado la aprobacion</td>
											
												";

											} else if($seguimiento->getEstadoSeguimiento()==1) {
												echo "
												
													<td>".$seguimiento->getComentarioAprobador()."</td>
											
												";
											}else if($seguimiento->getEstadoSeguimiento()==0){
												echo "
												
													<td>".$seguimiento->getComentarioAprobador()."</td>
											
												";

											}

											if($seguimiento->getEstadoSeguimiento() == null){

												echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>

												<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
											</tr>";
											}else{

												echo "
											
											<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ISeguimiento/IModificarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td>
					        				<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacion('".$seguimiento->getId()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
										</tr>";

											}

										


								}
							?>
						</tbody>
					</table>
				</div>
					<?php  
						}else{
							echo "<br><h3>A&uacuten no se han realizado aprobaciones</h3>";
						}
					?>
			</div>
		</div>

		<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idSeguimiento" name="idSeguimiento">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarSeguimientoAprobador()"/>
		</div>
	</div>

	<script>

	 $(document).ready(function() {
	   	 Materialize.updateTextFields();
 	 });
 	 $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
 	 });
	 
	 $( document ).ready(function(){
	   	$('.modal-trigger').leanModal();
	   	$('ul.tabs').tabs();
	});
  </script>	
