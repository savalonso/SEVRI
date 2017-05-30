<!DOCTYPE html>
	<?php
		session_start();
		if(!isset($_SESSION['tipo'])){
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
		}

		include ("../../Controladora/ctrListaRiesgo.php");
		$control = new ctrListaRiesgo;	
		$lista =$control->obtenerRiesgosAntiguos();

		include ("../../Controladora/ctrListaSevri.php");
		$controlS = new ctrListaSevri;	
		$listaS =$controlS->obtenerListaSevriAntiguos();

		include ("../../Controladora/ctrListaDepartamento.php");
		$controlD = new ctrListaDepartamento;	
		$listaD =$controlD->obtenerDepartamentosVersionesAntiguas();
	?>
	<script>
		window.onload=ocultarBarra();
	</script>			
	<div class="row">
		<h2>Historial de riesgos.</h2>
		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<div>
				<label class="white-text" for="sevri">Seleccione una versi&oacuten de SEVRI:</label>
				<select id="sevri" name="sevri" onchange="actualizarTablaAgregar()"> 
					<?php 
						if($listaS!=null){
							foreach ($listaS as $sevri){
								echo "<option value=".$sevri->getIdSevri()." >".$sevri->getNombreVersion()."</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<div>
				<label class="white-text" for="departamento">Seleccione un departamento:</label>
				<select id="departamento" name="departamento" onchange="actualizarTablaAgregar()">
					<?php
						if($listaD!=null){
							foreach ($listaD as $departamento){
								echo "<option value=".$departamento->getIdDepartamento()." >".$departamento->getNombreDepartamento()."</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<?php  
		if($lista==null){
			echo "<h3>A&UacuteN NO HAY RIESGOS IDENTIFICADOS EN VERSIONES ANTERIORES</h3>";
		}else{
	?>
	<div class="row">
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
			<div id="div1">
				<table class="responsive-table centered bordered" id="tabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacuten</th>
							<th>Ver detalles</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<?php 
							$contador=1;
							if($lista==null){
								echo "SELECCIONA UNA VERSI&OacuteN DE SEVRI Y UN DEPARTAMENTO";
							}else{
								foreach ($lista as $riesgo){
						            echo "<tr id=\"tr".$contador."\" style=\"display:none\">
						            	<td style=\"display:none\">".$riesgo->getIdSevri()."</td>
						            	<td style=\"display:none\">".$riesgo->getIdDepartamento()."</td>				        
							        	<td>".$riesgo->getNombre()."</td>
							        	<td>".$riesgo->getDescripcion()."</td>
						        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Ver detalles\" onclick=\"		cargarPagina('../interfaz/IHistorial/IVerDetalles.php?idRiesgo=".$riesgo->getId()."')\"/></td>
						    		</tr>";
						    		$contador++;
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php 	
		}
	?>
	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	  		$('select').material_select();
	  		$('.tooltipped').tooltip({delay: 50});
	  		actualizarTablaAgregar();
	   	});
	</script>