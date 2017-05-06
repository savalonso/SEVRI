<!DOCTYPE html>

<?php

	session_start();
	$cedulaAprobador=$_SESSION['idUsuario'];
	include("../../controladora/ctrListaSeguimientos.php");
	$control=new ctrListaSeguimientos;

	/*--Cristhoper--*/
	/*--------------*/
	$lista = $control->obtenerSeguimientosAsignados($cedulaAprobador);
	/*--Cristhoper--*/
	/*--------------*/

	/*--Victor--*/
	/*----------*/
	$administracionRiesgo = $control->obtenerAdministracionRiesgo($cedulaAprobador);

	$listaAdministracion;
	$listaAnalisis;
	$listaRiesgo;
	$listaMedida;

	$i=0;
	$ad = false;
	$an = false;
	$ri = false;
	$me = false;

	for($i; $i<count($administracionRiesgo); $i++){
		if($ad == false){
			$listaAdministracion = $administracionRiesgo[$i];
			$ad = true;
		} else if($an == false){
			$listaAnalisis = $administracionRiesgo[$i];
			$an = true;
		} else if($ri == false){
			$listaRiesgo = $administracionRiesgo[$i];
			$ri = true;
		} else{
			$listaMedida = $administracionRiesgo[$i];
			$ad = false;
			$an = false;
			$ri = false;
		}
	}

	if($administracionRiesgo != null){
		$i=0;
		for($i; $i<count($listaAdministracion); $i++){
			$arr[] = array(
					'Id' => $listaAdministracion[$i]->getId(),
					'ActividadTratamiento' => $listaAdministracion[$i]->getActividadTratamiento(),
					'PlazoTratamiento' => $listaAdministracion[$i]->getPlazoTratamiento(),
					'CostoActividad' => $listaAdministracion[$i]->getCostoActividad(),
					'Indicador' => $listaAdministracion[$i]->getIndicador(),
					'MedidaControl' => $listaAnalisis[$i]->getMedidaControl(),
					'NombreRiesgo' => $listaRiesgo[$i]->getNombre(),
					'CausaRiesgo' => $listaRiesgo[$i]->getCausa(),
					'NombreMedida' => $listaMedida[$i]->getNombreMedida()
				);
		}
		$ArrayJson = json_encode($arr);
	}
	/*--Victor--*/
	/*----------*/
 ?>
 <script>	
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();
	});
</script>

	<!--Tabs-->
	<!-------->
	<div class="row indicator">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab s4"><a href="#contenedorSeguimientosUsuario">Seguimientos Asignados</a></li>
				<li class="tab s4"><a href="#contenedorSeguimientosAprobador">Seguimientos a aprobar</a></li>
			</ul>
		</div>
	</div>	
	<!--Tabs-->
	<!-------->

	<!--Cristhoper-->
	<!-------------->
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
									if($seguimiento->getEstadoSeguimiento() == null) {
										echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Realizar aprobacion\" onclick=\"cargarPagina('../interfaz/ISeguimiento/IInsertarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td></tr>";
									} else if($seguimiento->getEstadoSeguimiento()==1) {
										echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Realizada\" /></td></tr>";
									} else if($seguimiento->getEstadoSeguimiento()==0) {
										echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Realizada\" /></td></tr>";
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
	<!--Cristhoper-->
	<!-------------->

	<!--Victor-->
	<!---------->
	<div id="contenedorSeguimientosUsuario">
		<div class="row">
		<?php
			if($listaAdministracion!=null){
		?>
		<h2>Seguimientos asignados</h2>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
			<div id="div1">
				<table class="responsive-table centered bordered">
					<thead>
						<tr>
							<th>Nombre del Riesgo</th>
							<th>Actividad de Tratamiento</th>
							<th>Opci&oacuten 1</th>
							<th>Opci&oacuten 2</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$j = 0;
							for($j; $j<count($listaAdministracion); $j++){
								echo "<tr>";
									echo "<td>".$listaRiesgo[$j]->getNombre()."</td>";
									echo "<td>".$listaAdministracion[$j]->getActividadTratamiento()."</td>";
									echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$listaAdministracion[$j]->getId()."), mostrarDatosModal()\" href=\"#Mmostrar\">Ver detalles</a></td>";
									echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Seguimiento\" onclick=\"cargarPagina('../interfaz/ISeguimiento/IRealizarSeguimiento.php?IdAdministracion=".$listaAdministracion[$j]->getId()."')\"/></td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
				<?php  
					} else {
						echo "<br><h3>A&uacuten no se han asignado seguimientos</h3>";
					}
				?>
			</div>
		</div>
	</div>
	<!--Victor-->
	<!---------->

<div id="Mmostrar" class="modal  blue darken-3 z-depth-5 white-text"></div>

<script>
/*Victor
------*/
	var idJs;
	function asignarID(id) {
		idJs = id;
	}
	function mostrarDatosModal() {
		var lista = eval(<?php echo $ArrayJson ?>);
		for(i=0;i<lista.length;i++){
			if(lista[i].Id == idJs){
				$('#Mmostrar').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td><h5>Actividad de tratamiento:</h5></td><td><h5>' + lista[i].ActividadTratamiento + '</h5></td></tr><tr><td><h5>Plazo del tratamiento:</h5></td><td><h5>' + lista[i].PlazoTratamiento + '</h5></td></tr><tr><td><h5>Costo de la actividad:</h5></td><td><h5>' + lista[i].CostoActividad + '</h5></td></tr><tr><td><h5>Indicador:</h5></td><td><h5>' + lista[i].Indicador + '</h5></td></tr><tr><td><h5>Medida de control:</h5></td><td><h5>' + lista[i].MedidaControl + '</h5></td></tr><tr><td><h5>Nombre del riesgo:</h5></td><td><h5>' + lista[i].NombreRiesgo + '</h5></td</tr><tr><td><h5>Causa del riesgo:</h5></td><td><h5>' + lista[i].CausaRiesgo + '</h5></td></tr><tr><td><h5>Nombre de la medida:</h5></td><td><h5>' + lista[i].NombreMedida + '</h5></td></tr></tbody></table></div>');
			}
		}
	}
/*Victor
------*/

/*Cristhoper
----------*/
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
/*Cristhoper
----------*/
</script>
