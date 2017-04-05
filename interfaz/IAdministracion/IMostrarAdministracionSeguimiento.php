<!DOCTYPE html>

<?php
	include ("../../Controladora/ctrListaAdministracion.php");
	$control = new ctrListaAdministracion;	
	$idAdministracion = $_GET['IdAdministracion'];
	$administracion =$control->obtenerAdministracion($idAdministracion);	
?>
	<script>
		window.onload=ocultarBarra();
	</script>

	<div class="row">
		<h2>Lista de riesgos</h2>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
		<?php  
			if($administracion!=null){
		?>
			<div id="div1">
				<table class="responsive-table centered bordered">
					<thead>
						<tr>
							<th>Medida</th>
							<th>Actividad de tratamiento</th>
							<th>Indicador</th>
							<th>Plazo</th>
							<th>Monto Econ&oacutemico</th>
							<th>Opción 1</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($administracion==null){
							echo "A&uacuten no se ha realizado ninguna administraci&oacuten";
						}else{
					            echo "<tr>				
						        	<td>".$administracion->getMedidaAdministracion()->getNombreMedida()."</td>
						        	<td>".$administracion->getActividadTratamiento()."</td>
						        	<td>".$administracion->getIndicador()."</td>
						        	<td>".$administracion->getPlazoTratamiento()."</td>
						        	<td>"."₡".number_format($administracion->getCostoActividad(), 2, ',', ' ')."</td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Realizar Seguimiento\" onclick=\"realizarSeguimiento('".$administracion->getId()."')\"/></td>
					    		</tr>";
						}
						?>
					</tbody>
					</table>
			</div>
				<?php  
					}else{
						echo "<h3>A&uacuten no se ha realizado ninguna administraci&oacuten</h3>";
					}
				?>	
		</div>
	</div>