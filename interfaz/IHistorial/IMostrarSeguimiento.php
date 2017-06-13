<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
	$idAdministracion = $_GET['idAdministracion'];
	include ("../../controladora/ctrListaSeguimientos.php");
	$control = new ctrListaSeguimientos;
	$lista = $control->obtenerSeguimientosPorIdAdministracion($idAdministracion);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
	window.onload=ocultarBarra();
</script>
<div class="row">
	<h4>Seguimiento del riesgo.</h4>
	<?php 
	if($lista==null){
		echo "No hay seguimientos para este riesgo.";
	}else{
	?>
	<table class="responsive-table centered bordered">
		<thead>
			<tr>
				<th>Monto del seguimiento</th>
				<th>Estado</th>
				<th>Comentario del aprovador</th>
				<th>Comentario de avance</th>
				<th>Porcentaje de avance</th>
				<th>Fecha del avance</th>
				<th>Aprobador</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($lista as $seguimiento){
	            echo "<tr>					        
		        	<td>"."₡".number_format($seguimiento->getMontoSeguimiento())."</td>";
		        	if($seguimiento->getEstadoSeguimiento()==1){
		        		echo "<td>Aprobado</td>";
		        	}else{
		        		echo "<td>No aprovado</td>";
		        	}
		        	echo "<td>".$seguimiento->getComentarioAprobador()."</td>
					<td>".$seguimiento->getComentarioAvance()."</td>
					<td>".$seguimiento->getPorcentajeAvance().'%'."</td>
					<td>".$seguimiento->getFechaAvance()."</td>
					<td>".$seguimiento->getUsuarioAprobador()."</td>
	    		</tr>";
			}
			?>
		</tbody>
	</table>
	<?php 
		}
	?>
</div>