<!DOCTYPE html>

<?php

	session_start();
	$cedulaAprobador=$_SESSION['idUsuario'];
	include("../../controladora/ctrListaSeguimientos.php");
	$control=new ctrListaSeguimientos;
	$lista=$control->obtenerSeguimientosAsignados($cedulaAprobador);

 ?>

 <script>	
		window.onload=ocultarBarra();
		$( document ).ready(function(){
	   	$('select').material_select();
	   	});
	</script>


	<div class="row indicator">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab s4"><a href="#contenedorSeguimientosUsuario">Seguimientos Asignados</a></li>
				<li class="tab s4"><a href="#contenedorSeguimientosAprobador">Seguimientos a aprobar</a></li>
			</ul>
		</div>
	</div>	

	<div id="contenedorSeguimientosAprobador">
		<div class="row">
			<?php  
				if($lista!=null){
			?>

			<h2>Seguimientos asignados</h2>
			<div class="col s12 m12 l12 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered">
						<thead>
							<tr>
								<th>Actividad</th>
								<th>Porcentaje de avance</th>
								<th>Comentario de avance</th>
								<th>Monto de Seguimiento</th>
								<th>Fecha de avance</th>
								<th>Aprobacion</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							
								foreach ($lista as $seguimiento){
									
									echo "<tr>
											<td>".$seguimiento->getActividadTratamiento()."</td>
											<td>"."%".$seguimiento->getPorcentajeAvance()."</td>
											<td>".$seguimiento->getComentarioAvance()."</td>
											<td>"."₡".number_format($seguimiento->getMontoSeguimiento(), 2, ',', ' ')."</td>
											<td>".$seguimiento->getFechaAvance()."</td>";
											
											if($seguimiento->getEstadoSeguimiento() == null){
													

											echo "
												<td><input class=\"btn btn-default\" type=\"button\" value=\"Realizar aprobacion\" onclick=\"cargarPagina('../interfaz/ISeguimiento/IInsertarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td>
											</tr>";
											} else if($seguimiento->getEstadoSeguimiento()==1) {
											echo "
											<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Realizada\" /></td>
	

											</tr>";
											}else if($seguimiento->getEstadoSeguimiento()==0){
												echo "
									

												<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Realizada\" /></td>
												</tr>";
											}
								}
							?>
						</tbody>
					</table>
				</div>
					<?php  
						}else{
							echo "<br><h3>A&uacuten no se han asignado aprobaciones</h3>";
						}
					?>
			</div>
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
