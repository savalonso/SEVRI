<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
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

	<?php  
		if($administracion!=null){
	?>

	<div class="row">
		<h4>Medida de Administración</h4>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
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
				            echo "<tr>				
					        	<td>".$administracion->getMedidaAdministracion()->getNombreMedida()."</td>
					        	<td>".$administracion->getActividadTratamiento()."</td>
					        	<td>".$administracion->getIndicador()."</td>
					        	<td>".$administracion->getPlazoTratamiento()."</td>
					        	<td>"."₡".number_format($administracion->getCostoActividad(), 2, ',', ' ')."</td>
				        		<td><input class=\"btn btn-default btnAccionCrud btnModal\" type=\"button\" value=\"Realizar Seguimiento\" onclick=\"cargarPagina('../interfaz/ISeguimiento/IRealizarSeguimiento.php?IdAdministracion=".$administracion->getId()."')\"/></td>
				    		</tr>";
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