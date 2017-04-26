<!DOCTYPE html>

<?php

	session_start();
	$cedulaAprobador=$_SESSION['idUsuario'];

	include("../../controladora/ctrListaSeguimientos.php");
	$control=new ctrListaSeguimientos;
	$lista=$control->obtenerSeguimientosAprobador($cedulaAprobador);

	foreach($lista as $seguimiento){
		$arreglo[]=array(
			'_id'=>$seguimiento->getId(),
			'porcentaje'=>$seguimiento->getPorcentajeAvance(),
			'comentario'=>$seguimiento->getComentarioAvance(),
			'monto'=>$seguimiento->getMontoSeguimiento(),
			'fecha'=>$seguimiento->getFechaAvance()
		);
	}

	$ArrayJsonSeguimiento = json_encode($arreglo);

	
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
				<li class="tab s4"><a href="#contenedorSeguimientosUsuario">Seguimientos realizados</a></li>
				<li class="tab s4"><a href="#contenedorSeguimientosAprobador">Seguimientos aprobados/reprobados</a></li>
			</ul>
		</div>
	</div>	

	<div id="contenedorSeguimientosAprobador">
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
								<th>Porcentaje avance</th>
								<th>Estado del seguimiento</th>
								<th>Comentario del aprobador</th>
								<th>Opcion 1</th>
								<th>Opcion 2</th>
								<th>Opcion 3</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
								foreach ($lista as $seguimiento){

										
									
									echo "<tr>
											<td>".$seguimiento->getPorcentajeAvance()."%"."</td>
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

												<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Ver detalles\" /></td>

											</tr>";
											}else if($seguimiento->getEstadoSeguimiento()==1){

												echo "
											
												<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ISeguimiento/IModificarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td>
												<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>

												<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$seguimiento->getId()."),  mostrarSeguimientoModal()\" href=\"#MmostrarSeguimiento\">Ver detalles</a></td>
					        				
												</tr>";

											}else if($seguimiento->getEstadoSeguimiento()==0){

											
													echo "
											
													<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ISeguimiento/IModificarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td>
					        						<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacion('".$seguimiento->getId()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button></td>
					        						<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$seguimiento->getId()."),  mostrarSeguimientoModal()\" href=\"#MmostrarSeguimiento\">Ver detalles</a></td>

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

	<div id="MmostrarSeguimiento" class="modal  blue darken-3 z-depth-5 white-text"></div>

	</div>
		



<script>

var idSeguimientoDetalles;

function asignarID(id)
{
	idSeguimientoDetalles = id;
	
}
 
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

function mostrarSeguimientoModal(){

	var lSeguimiento = eval(<?php echo $ArrayJsonSeguimiento ?>);
	

	for(i=0;i<lSeguimiento.length;i++){
		if(lSeguimiento[i]._id == idSeguimientoDetalles){
			$('#MmostrarSeguimiento').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td><h5>Porcentaje:</h5></td><td><h5>' + lSeguimiento[i].porcentaje +'%'+ '</h5></td></tr><tr><td><h5>Comentario:</h5></td><td><h5>' + lSeguimiento[i].comentario + '</h5></td></tr><tr><td><h5>Monto:</h5></td><td><h5>' +'₡'+ lSeguimiento[i].monto + '</h5></td></tr><tr><td><h5>Fecha:</h5></td><td><h5>' + lSeguimiento[i].fecha +'</h5></td></tr></tbody></table></div>');
		}
	}
}
  </script>	
