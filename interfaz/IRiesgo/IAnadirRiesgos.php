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
		$listaD =$controlD->obtenerListaDepartamentosUsuario($_SESSION['idUsuario']);
	?>
	<script>
		window.onload=ocultarBarra();
	</script>			
	<div class="row">
		<h4>A&ntilde;adir riesgo de versi&oacuten antigua.</h4>

		<?php
			if ($lista != null) {
		 ?>

		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<div>
				<label class="white-text" for="sevri">Seleccione una versi&oacuten de SEVRI:</label>
				<select id="sevri" name="sevri" onchange="actualizarTablaAgregar()"> 
					<option selected="true" value="0">Seleccione una versi&oacuten de SEVRI...</option>
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
					<option selected="true" value="0">Seleccione un departamento...</option>
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
	<div class="row">
		<?php  
			if($lista!=null){
		?>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
			<div id="div1">
				<table class="responsive-table centered bordered" id="tabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacuten</th>
							<th>A&ntilde;adir</th>
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
						        		<td><input class=\"btn btn-default\" type=\"button\" value=\"A&ntilde;adir\" onclick=\"		cargarPagina('../interfaz/IRiesgo/IAnadirRiesgo.php?idRiesgo=".$riesgo->getId()."')\"/></td>
						    		</tr>";
								}
							}
						?>
					</tbody>
				</table>
			</div>
				<?php  
					}else{
						echo "<h4>A&uacuten no hay versiones anteriores del SEVRI con riesgos identificados.</h4>";
					}
				?>
		</div>
	</div>
	
	<?php 
		}else{ 
	?>
	
	<h4>A&uacuten no hay versiones anteriores del SEVRI con riesgos identificados.</h4>

	<?php 
		} 
	?>

	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	  		$('select').material_select();
	  		$('.tooltipped').tooltip({delay: 50});
	   	});
	   	function actualizarTablaAgregar(){
	   		var idSevri = document.getElementById("sevri").value;
	   		var idDepa = document.getElementById("departamento").value;

	   		var tbody = document.getElementById("tbody");//obtengo el objeto tabla del html
	   		var tabla = document.getElementById("tabla");

	   		if(idSevri == 0 && idDepa != 0){//combo depa seleccionado
	   			for(j=1;j<tabla.rows.length;j++){
		   			if(document.getElementById("tr"+j).cells[1].childNodes[0].nodeValue==idDepa){
		   				document.getElementById("tr"+j).style.display = "";
		   			}else{
		   				document.getElementById("tr"+j).style.display = "none";
		   			}
		   		}
	   		}else if(idSevri != 0 && idDepa == 0){//combo sevri seleccionado
	   			for(j=1;j<tabla.rows.length;j++){
		   			if(document.getElementById("tr"+j).cells[0].childNodes[0].nodeValue==idSevri){
		   				document.getElementById("tr"+j).style.display = "";
		   			}else{
		   				document.getElementById("tr"+j).style.display = "none";
		   			}
		   		}
	   		}else if(idSevri != 0 && idDepa != 0){//ambos combos seleccionados
	   			for(j=1;j<tabla.rows.length;j++){
		   			if(document.getElementById("tr"+j).cells[0].childNodes[0].nodeValue==idSevri && document.getElementById("tr"+j).cells[1].childNodes[0].nodeValue==idDepa){
		   				document.getElementById("tr"+j).style.display = "";
		   			}else{
		   				document.getElementById("tr"+j).style.display = "none";
		   			}
		   		}
	   		}else if(idSevri == 0 && idDepa == 0){//ambos des desleccionados
	   			for(j=1;j<tabla.rows.length;j++){
		   			document.getElementById("tr"+j).style.display = "none";
		   		}
	   		}
	   	}
	</script>