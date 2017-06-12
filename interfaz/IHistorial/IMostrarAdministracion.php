<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
	$idAnalisis = $_GET['idAnalisis'];
	include ("../../controladora/ctrListaAdministracion.php");
	$control = new ctrListaAdministracion;
	$lista = $control->obtenerAdministraciones($idAnalisis);
?>
<script>
	window.onload=ocultarBarra();
</script>
<div class="row">
	<h4>Administraci&oacuten(es) del riesgo.</h4>
	<?php  
		if($lista==null){
				echo "No hay administraciones para este riesgo.";
		}else{
	?>
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
			foreach ($lista as $administracion){
	            echo "<tr>					        
		        	<td>".$administracion->getActividadTratamiento()."</td>
		        	<td>".$administracion->getMedidaAdministracion()->getDescripcionMedida()."</td>
		        	<td>".$administracion->getUsuario()->getNombre()."</td>
					<td>".$administracion->getActividadTratamiento()."</td>
					<td>".$administracion->getPlazoTratamiento()."</td>
					<td>"."₡".number_format($administracion->getCostoActividad())."</td>
					<td>".$administracion->getIndicador()."</td>
	        		<td><input id=\"btnSeguimiento\" class=\"btn btn-default\" type=\"button\" value=\"Ver seguimientos\" onclick=\"cargarPaginaHistorialS('../interfaz/IHistorial/IMostrarSeguimiento.php?idAdministracion=".$administracion->getId()."');mover()\"/></td>
	    		</tr>";
			}
			?>
		</tbody>
	</table>
	<?php 
		}
	?>
</div>
<script type="text/javascript">
    function mover(){
    	$('html,body').animate({
            scrollTop: $("#contenedorSeguimiento").offset().top
        }, 2000);
    }
</script>