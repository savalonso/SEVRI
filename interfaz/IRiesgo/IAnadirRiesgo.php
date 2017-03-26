<!DOCTYPE html>
	<?php
		include ("../../Controladora/ctrListaRiesgo.php");
		$control = new ctrListaRiesgo;	
		$lista =$control->obtenerRiesgosAntiguos();

		include ("../../Controladora/ctrListaSevri.php");
		$controlS = new ctrListaSevri;	
		$listaS =$controlS->obtenerListaSevriAntiguos();
	?>
	<script>
		window.onload=ocultarBarra();
	</script>			
	<div class="row">
		<h2>A&ntilde;adir riesgo de versi&oacuten antigua.</h2>
		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<div>
				<label class="white-text" for="sevri">Seleccione una versi&oacuten de SEVRI:</label>
				<select id="sevri" name="sevri"> 
					<option disabled="true" selected="true" value="0">Seleccione una versi&oacuten de SEVRI...</option>
					<?php 
						foreach ($listaS as $sevri){
							echo "<option value=".$sevri->getIdSevri()." >".$sevri->getNombreVersion()."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<div>
				<label class="white-text" for="departamento">Seleccione un departamento:</label>
				<select id="departamento" name="departamento"> 
					<option value="1">Finanzas</option>
					<option value="0">Inactivo</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
		<?php  
			if($lista!=null){
		?>
			<div id="div1">
				<table class="responsive-table centered bordered">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacuten</th>
							<th>A&ntilde;adir</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$contador=1;
							if($lista==null){
								echo "SELECCIONA UNA VERSI&OacuteN DE SEVRI Y UN DEPARTAMENTO";
							}else{
								foreach ($lista as $riesgo){
						            echo "<tr id=\"tr".$contador."\" style=\"display:none\">
						            	<td style=\"display:none\">".$riesgo->getIdDepartamento()."</td>				        
							        	<td>".$riesgo->getNombre()."</td>
							        	<td>".$riesgo->getDescripcion()."</td>
						        		<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacion('".$riesgo->getNombre()."','".$riesgo->getDescripcion()."')\"><a class=\"btn\" href=\"#\">A&ntilde;adir</a> </button></td>
						    		</tr>";
								}
							}
						?>
					</tbody>
					</table>
			</div>
				<?php  
					}else{
						echo "<h3>A&uacuteN NO HAY RIESGOS IDENTIFICADOS EN VERSIONES ANTERIORES</h3>";
					}
				?>
		</div>
	</div>

	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	  		$('select').material_select();
	  		$('.tooltipped').tooltip({delay: 50});
	   	});
	</script>