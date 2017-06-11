<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>

<?php

	$idDepartamento=$_GET['id'];
	include ("../../controladora/ctrListaRiesgo.php");
	$control = new ctrListaRiesgo;	
	$lista =$control->obtenerRiesgosAnalisados($idDepartamento);	
?>
	<script>
		window.onload=ocultarBarra();
	</script>

	<?php  
		if($lista != null){
	?>
	<div class="row">
		<h4>Lista de riesgos para administrar</h4>
		<div class="input-field buscar1 col s8 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="datosAdministracion" type="text">
        </div>
        <div class="col l4 m4 s4">
					<a id="boton" href="#" onclick="cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalisis.php')" data-tooltip="Realizar Analisis" class="btn-floating tooltipped btn-large waves-effect waves-light red" style="float: right;"><i class="material-icons">add</i></a>
		</div>
		<div class="col s12 m12 l12 scrollH">
			<div id="div1">
				<table class="responsive-table striped responsive2">
					<thead>
						<tr>
							<th>Riesgo</th>
							<th>Opci&oacuten 1</th>
							<th>Opci&oacuten 2</th>
						</tr>
					</thead>
					<tbody id="datosAd">
						<?php 
							foreach ($lista as $riesgo){
					            echo "<tr>					        
						        	<td>".$riesgo->getNombre()."</td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Administrar\" onclick=\"cargarPagina('../interfaz/IAdministracion/IAdministrarRiesgo.php?idAnalisis=".$riesgo->getId()."')\"/></td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Ver Administraciones\" onclick=\"cargarPagina('../interfaz/IAdministracion/IMostrarAdministraciones.php?idAnalisis=".$riesgo->getId()."')\"/></td>
					    		</tr>";
							}
						
						?>
					</tbody>
					</table>
			</div>
		</div>
	</div>
	<?php  
	    }else{ ?>

			<div class="row">
				<h4 class="col s10 m10 l10">A&uacuten no se ha realizado el An&aacutelisis sobre ning&uacuten riesgo</h4>
				<div class="col l2 m2 s2">
					<a id="boton" href="#" onclick="cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalisis.php')" data-tooltip="Análizar Riesgo" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
				</div>
			</div>
		<?php }?>	
	
	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	  		$('.tooltipped').tooltip({delay: 50});
	   	});
	</script>