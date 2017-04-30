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

	<div class="row">
		<h2>Lista de riesgos</h2>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
		<?php  
			if($lista!=null){
		?>
			<div id="div1">
				<table class="responsive-table centered bordered">
					<thead>
						<tr>
							<th>Riesgo</th>
							<th>Opci&oacuten 1</th>
							<th>Opci&oacuten 2</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($lista==null){
							echo "A&uacuten no se ha realizado el An&aacutelisis sobre ning&uacuten riesgo";
						}else{
							foreach ($lista as $riesgo){
					            echo "<tr>					        
						        	<td>".$riesgo->getNombre()."</td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Admininistrar\" onclick=\"cargarPagina('../interfaz/IAdministracion/IAdministrarRiesgo.php?idAnalisis=".$riesgo->getId()."')\"/></td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Ver Administraciones\" onclick=\"cargarPagina('../interfaz/IAdministracion/IMostrarAdministraciones.php?idAnalisis=".$riesgo->getId()."')\"/></td>
					    		</tr>";
							}
						}
						?>
					</tbody>
					</table>
			</div>
				<?php  
					}else{
						echo "<h3>A&uacuten no se ha realizado el An&aacutelisis sobre ning&uacuten riesgo</h3>";
					}
				?>	
		</div>
	</div>

	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	   	});
	</script>