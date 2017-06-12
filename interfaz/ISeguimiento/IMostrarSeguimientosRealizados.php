<!DOCTYPE html>

<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
	$cedulaAprobador=$_SESSION['idUsuario'];
	include_once("../../controladora/ctrListaSeguimientos.php");
	include_once("../../controladora/ctrListaAdministracion.php");
	$control = new ctrListaSeguimientos;
	$controlAdministracion = new ctrListaAdministracion;
	$lista = $control->obtenerSeguimientosAprobador($cedulaAprobador);
	$listaAdministracion = $controlAdministracion->getAdministracionResponsable($cedulaAprobador);

	$arreglo = array();
	if($lista != null){
		foreach($lista as $seguimiento){
			$arreglo[]=array(
				'_id'=>$seguimiento->getId(),
				'porcentaje'=>$seguimiento->getPorcentajeAvance(),
				'comentario'=>$seguimiento->getComentarioAvance(),
				'monto'=>number_format($seguimiento->getMontoSeguimiento(), 2, ',', '.'),
				'fecha'=>$seguimiento->getFechaAvance()
			);
		}
	}
	$ArrayJsonSeguimiento = json_encode($arreglo);	
	
	$listaSeguimientos = array();
	if($listaAdministracion != null) {
		foreach($listaAdministracion as $administracion) {
			$seguimientos = $control->obtenerSeguimiento($administracion->getId());
			array_push($listaSeguimientos, $seguimientos);
		}
	}
	$arregloSeg = array();
	if($listaSeguimientos != null){
		foreach($listaSeguimientos as $seguimientos) {
			if($seguimientos != null){
				foreach($seguimientos as $seg){
					$arregloSeg[]=array(
					'_id'=>$seg->getId(),
					'porcentaje'=>$seg->getPorcentajeAvance(),
					'comentario'=>$seg->getComentarioAvance(),
					'monto'=>number_format($seg->getMontoSeguimiento(), 2, ',', '.'),
					'fecha'=>$seg->getFechaAvance()
					);
				}
			}
		}
	}
	$seguimiento_json = json_encode($arregloSeg);
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
			<h2>Lista seguimientos aprobados</h2>
			<div>
				<div >
					<table class="responsive-table striped centered responsive2">
						<thead>
							<tr>
								<th>Porcentaje avance</th>
								<th>Estado del seguimiento</th>
								<th>Comentario del aprobador</th>
								<th>Opci&oacuten 1</th>
								<th>Opci&oacuten 2</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($lista as $seguimiento){
									echo "<tr><td>".$seguimiento->getPorcentajeAvance()."%"."</td>";
									if($seguimiento->getEstadoSeguimiento()==1) {
										echo "<td>Aprobado</td>";
										echo "<td>Seguimiento aprobado</td>";

									} else if($seguimiento->getEstadoSeguimiento()==0) {
										echo "<td>Reprobado</td>";
										echo "<td>".$seguimiento->getComentarioAprobador()."</td>";
									}
								
									if($seguimiento->getEstadoSeguimiento()==1) {
										echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ISeguimiento/IModificarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td>
											  <td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
											 </tr>";

									} else if($seguimiento->getEstadoSeguimiento()==0) {
										echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ISeguimiento/IModificarSeguimientoAprobador.php?idSeguimiento=".$seguimiento->getId()."')\"/></td>
											  <td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacion('".$seguimiento->getId()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button></td>
											</tr>";	

									}
								}
							?>
						</tbody>
					</table>
				</div>
				<?php  
					} else {
						echo "<br><h4>A&uacuten no se han realizado aprobaciones</h4>";
					}
				?>
			</div>
		</div>
	</div>

<div id="contenedorSeguimientosUsuario">
	<div class="row">
		<div class="col s12 m12 l12" style="margin:10px;">
			<div class="col s12 m6 l6">
				<label>Seleccione un Seguimiento</label>
				<select id="selecSegui" name="selecSegui" onchange="verSeguimientos()">
					<option value="0" disabled="true" selected>Seleccione una opci&oacuten</option>
					<?php
						foreach ($listaAdministracion as $administracion){
							echo "<option value=".$administracion->getId().">".$administracion->getActividadTratamiento()."</option>";
						}
					?>
				</select>
			</div>
		</div>
<?php
if($listaSeguimientos != null) {
	if($listaAdministracion != null) {
		foreach ($listaAdministracion as $administracion) {
?>
		<div class="col s12 m12 l12" name="seg" id="table_<?=$administracion->getId()?>" style="display:none">
			<h4><?=$administracion->getActividadTratamiento()?></h4>
				<table class="responsive-table centered bordered">
					<thead>
						<tr>
							<th>Porcentaje avance</th>
							<th>Estado del seguimiento</th>
							<th>Comentario del aprobador</th>
							<th>Opcion 1</th>
							<th>Opcion 2</th>
							<th>Opcion 3</th>
							<th>Opcion 4</th>
						</tr>
					</thead>
					<tbody>
<?php
foreach($listaSeguimientos as $seguimientos) {
	if($seguimientos != null){
		foreach($seguimientos as $seg){
			if($administracion->getId() == $seg->getActividadTratamiento()){
?>
						<tr>
							<td><?= $seg->getPorcentajeAvance()."%"?></td>
							<?php
							if($seg->getEstadoSeguimiento() == null){
								echo "<td>A&uacuten no se ha realizado la aprobaci&oacuten</td>";
							} else if($seg->getEstadoSeguimiento()==1) {
								echo "<td>Aprobado</td>";
							} else if($seg->getEstadoSeguimiento()==0) {
								echo "<td>Reprobado</td>";
							}
							if($seg->getComentarioAprobador() == null) {
								echo "<td>A&uacuten no se ha realizado la aprobaci&oacuten</td>";
							} else {
								echo "<td>".$seg->getComentarioAprobador()."</td>";
							}
							if($seg->getEstadoSeguimiento() == null) {
								echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ISeguimiento/IModificarSeguimentoAsignado.php?idAdministracion=".$administracion->getId()."&idSeguimiento=".$seg->getId()."')\"/></td>
									<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$seg->getId().")\" href=\"#Meliminar2\">Eliminar</a></td>
									<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$seg->getId()."),  mostrarSeguimientoModal2()\" href=\"#MmostrarSeguimiento\">Ver detalles</a></td>";
							} else {
								echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>
									<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
									<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Ver detalles\" /></td>";
							}
							if($seg->getArchivo() != "") {
							echo "<td><a class=\"btn waves-effect waves-light\" onclick=\"document.location='../archivos/".$seg->getArchivo()."'\">Archivo</a></td>";
							} else {
								echo "<td><button class=\"btn waves-effect waves-light\" disabled=\"disabled\">Archivo</button></td>";
							}
							?>
						</tr>
<?php
						}
					}
				}
			}
?>
					</tbody>
				</table>
			</div>
<?php
		}
	}
} else {
	echo "<br><h4>A&uacuten no se han realizado aprobaciones</h4>";
}
?>		
		</div>
	</div>
</div>

	<div class="row">
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=4" class="btn">Crear Reporte Excel</a>
		</div>

		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=9" class="btn">Crear Reporte Word</a>
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

<div id="Meliminar2" class="modal  blue darken-3 z-depth-5 white-text">
	<div class="modal-content">
		<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
	</div>
	<div class="modal-footer blue darken-3 z-depth-5">
		<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="confirmarEliminar()"/>
	</div>
</div>

<script>
	var id = 0;
	var idSeguimientoDetalles;
	function asignarID(id){
		idSeguimientoDetalles = id;
	}
	function confirmarEliminar(){
        eliminarSeguimiento(idSeguimientoDetalles);
    }
 	 $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
 	 });
	 
	 $( document ).ready(function(){
		 $('select').material_select();
		 $('.modal-trigger').leanModal();
		 $('ul.tabs').tabs();
		 Materialize.updateTextFields();
	});

	function verSeguimientos() {
		if(id == 0){
			id = $('#selecSegui').val();
			document.getElementById("table_"+id).style.display = "block";
		} else {
			document.getElementById("table_"+id).style.display = "none";
			id = $('#selecSegui').val();
			document.getElementById("table_"+id).style.display = "block";
		}
	}

	function mostrarSeguimientoModal(){
		var lSeguimiento = eval(<?php echo $ArrayJsonSeguimiento ?>);
		for(i=0;i<lSeguimiento.length;i++){
			if(lSeguimiento[i]._id == idSeguimientoDetalles){
				$('#MmostrarSeguimiento').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td><h5>Porcentaje:</h5></td><td><h5>' + lSeguimiento[i].porcentaje +'%'+ '</h5></td></tr><tr><td><h5>Comentario:</h5></td><td><h5>' + lSeguimiento[i].comentario + '</h5></td></tr><tr><td><h5>Monto:</h5></td><td><h5>' +'₡'+ lSeguimiento[i].monto + '</h5></td></tr><tr><td><h5>Fecha:</h5></td><td><h5>' + lSeguimiento[i].fecha +'</h5></td></tr></tbody></table></div>');
			}
		}
	}
	function mostrarSeguimientoModal2(){
		var lSeguimiento = eval(<?php echo $seguimiento_json ?>);
		for(i=0;i<lSeguimiento.length;i++){
			if(lSeguimiento[i]._id == idSeguimientoDetalles){
				$('#MmostrarSeguimiento').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td><h5>Porcentaje:</h5></td><td><h5>' + lSeguimiento[i].porcentaje +'%'+ '</h5></td></tr><tr><td><h5>Comentario:</h5></td><td><h5>' + lSeguimiento[i].comentario + '</h5></td></tr><tr><td><h5>Monto:</h5></td><td><h5>' +'₡'+ lSeguimiento[i].monto + '</h5></td></tr><tr><td><h5>Fecha:</h5></td><td><h5>' + lSeguimiento[i].fecha +'</h5></td></tr></tbody></table></div>');
			}
		}
	}
  </script>	