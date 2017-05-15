<?php
	$idAnalisis = $_GET['idAnalisis'];
	include ("../../controladora/ctrListaAdministracion.php");
	$control = new ctrListaAdministracion;
	$lista = $control->obtenerAdministraciones($idAnalisis);
?>
<script>
	window.onload=ocultarBarra();
</script>
<div class="row">
	<h2>Administraci&oacuten(es) del riesgo.</h2>
	<table class="responsive-table centered bordered">
		<thead>
			<tr>
				<th>Nombre de la actividad</th>
				<th>Descripci&oacuten de la actividad</th>
				<th>Responsable</th>
				<th>Actividad de tratamiento</th>
				<th>Plazo de tratamiento</th>
				<th>Costo de la actividad</th>
				<th>Indentificador</th>
				<th>Seguimiento</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($lista==null){
				echo "NO HAY ADMINISTRACIONES PARA ESTE REISGO.";
			}else{
				foreach ($lista as $administracion){
		            echo "<tr>					        
			        	<td>".$administracion->getActividadTratamiento()."</td>
			        	<td>".$administracion->getMedidaAdministracion()->getDescripcionMedida()."</td>
			        	<td>".$administracion->getUsuario()->getNombre()."</td>
						<td>".$administracion->getActividadTratamiento()."</td>
						<td>".$administracion->getPlazoTratamiento()."</td>
						<td>"."₡".number_format($administracion->getCostoActividad())."</td>
						<td>".$administracion->getIndicador()."</td>
		        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Ver seguimientos\" onclick=\"		cargarPaginaHistorialS('../interfaz/IHistorial/IMostrarSeguimiento.php?idAdministracion=".$administracion->getId()."')\"/></td>
		    		</tr>";
				}
			}
			?>
		</tbody>
	</table>
</div>