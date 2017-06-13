<!DOCTYPE html>

<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
	$cedulaAprobador=$_SESSION['idUsuario'];
	include("../../controladora/ctrListaSeguimientos.php");
	$control=new ctrListaSeguimientos;

	
	$lista = $control->obtenerSeguimientosAsignados($cedulaAprobador);

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
	$arr[] = array();
	if($administracionRiesgo != null){
		$i=0;
		for($i; $i<count($listaAdministracion); $i++){
			$arr[] = array(
					'Id' => $listaAdministracion[$i]->getId(),
					'ActividadTratamiento' => $listaAdministracion[$i]->getActividadTratamiento(),
					'PlazoTratamiento' => $listaAdministracion[$i]->getPlazoTratamiento(),
					'CostoActividad' => number_format($listaAdministracion[$i]->getCostoActividad(), 2, ',', ' '),
					'Indicador' => $listaAdministracion[$i]->getIndicador(),
					'MedidaControl' => $listaAnalisis[$i]->getMedidaControl(),
					'NombreRiesgo' => $listaRiesgo[$i]->getNombre(),
					'CausaRiesgo' => $listaRiesgo[$i]->getCausa(),
					'NombreMedida' => $listaMedida[$i]->getNombreMedida()
				);
		}
	}
	$ArrayJson = json_encode($arr);
	
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
	<!--Tabs-->
	<!-------->

	<!--Cristhoper-->
	<!-------------->
	<div id="contenedorSeguimientosAprobador">
		<div class="row">
			<?php  
				if($lista!=null){
			?>
			<div class="col s12 m12 l12">
				<h4>Seguimientos a aprobar</h4>
				<table class="responsive-table striped centered responsive2">
					<thead>
						<tr>
							<th>Actividad</th>
							<th>Porcentaje de avance</th>
							<th>Comentario de avance</th>
							<th>Monto de Seguimiento</th>
							<th>Fecha de avance</th>
							<th>Opci&oacuten</th>
							
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
								
									echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Aprobar\" onclick=\"cargarPagina('../interfaz/ISeguimiento/IInsertarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td></tr>";
								
							}
						?>
					</tbody>
				</table>
				<?php  
					}else{
						echo "<br><h4>A&uacuten no se han asignado aprobaciones</h4>";
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
			<div class="col s12 m12 l12">
				<h4>Seguimientos asignados</h4>
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
				<?php  
					} else {
						echo "<br><h4>A&uacuten no se han asignado seguimientos</h4>";
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
				$('#Mmostrar').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td>Actividad de tratamiento:</td><td>' + lista[i].ActividadTratamiento + '</td></tr><tr><td>Plazo del tratamiento:</td><td>' + lista[i].PlazoTratamiento + '</td></tr><tr><td>Costo de la actividad:</td><td>₡ ' + lista[i].CostoActividad + '</td></tr><tr><td>Indicador:</td><td>' + lista[i].Indicador + '</td></tr><tr><td>Medida de control:</td><td>' + lista[i].MedidaControl + '</td></tr><tr><td>Nombre del riesgo:</td><td>' + lista[i].NombreRiesgo + '</td</tr><tr><td>Causa del riesgo:</td><td>' + lista[i].CausaRiesgo + '</td></tr><tr><td>Nombre de la medida:</td><td>' + lista[i].NombreMedida + '</td></tr></tbody></table></div>');
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
