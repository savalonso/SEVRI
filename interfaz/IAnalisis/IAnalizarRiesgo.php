<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>
	<?php

		$idDepartamento=$_GET['id'];
	
		include_once("../../controladora/ctrListaRiesgo.php");
		$control=new ctrListaRiesgo;
		$listaRiesgos=$control->obtenerRiesgosSinAnalisis($idDepartamento);
		

	?>
	<script>
		window.onload=ocultarBarra();
	</script>			

<div class="row">
	<?php  
		if($listaRiesgos==null){?>
		<div class="col s8 m8 l8">
			<h3>Aún no hay riesgos identificados</h3>
		</div>
		<div class="col s2 m2 l2">
			<a id="boton" href="#" onclick="cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')" data-tooltip="Identificar un nuevo riesgo." class="btn-floating tooltipped btn-large waves-effect waves-light blue "><i class="material-icons">add</i></a>
		</div>
		<?php
		}else{
	?>
	<h2>Lista de riesgos</h2>
	<div class="input-field buscar1 col s12 m8 l8">
        <label class="white-text" for="filtrar">Buscar</label>
        <input id="datosAnalisis2" type="text" >
	</div>
	<div class="col s12 m12 l12">
		<div id="div1">
		<table class="responsive-table responsive centered bordered">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripci&oacuten</th>
					<th>Estado</th>
					<th>Monto Econ&oacutemico</th>
					<th>Categor&iacutea</th>
					<th>Causa</th>
					<th>Fecha Registro</th>
					<th>Opcion 1</th>
				</tr>
			</thead>
			<tbody id="filtrarA">
			<?php 
				foreach ($listaRiesgos as $riesgo){
					echo "<tr>
								<td>".$riesgo->getNombre()."</td>
								<td>".$riesgo->getDescripcion()."</td>
								<td>".$riesgo->getEstaActivo()."</td>
								<td> ‎"."₡".number_format($riesgo->getMontoEconomico(), 2, ',', ' ')."</td>
								<td>".$riesgo->getIdCategoria()."</td>
								<td>".$riesgo->getCausa()."</td>
								<td>".$riesgo->getFecha()."</td>
							<td><input class=\"btn btn-default\" type=\"button\" value=\"Analizar\" onclick=\"cargarPagina('../interfaz/IAnalisis/IAnalisisRiesgo.php?idRiesgo=".$riesgo->getId()."')\"/></td>
						</tr>";
				}
			?>
			</tbody>
		</table>
	</div>
		<?php 
			}
		?>	
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.modal-trigger').leanModal();
		$('.tooltipped').tooltip({delay: 10});
	});
</script>