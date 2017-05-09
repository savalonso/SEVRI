<?php
	$idAdministracion = $_GET['idAdministracion'];
	include ("../../controladora/ctrListaSeguimientos.php");
	$control = new ctrListaSeguimientos;
	$lista = $control->obtenerSeguimientosPorIdAdministracion($idAdministracion);
?>
<script>
	window.onload=ocultarBarra();
</script>
<div class="row">
	<h2>Seguimiento del riesgo.</h2>
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
			if($lista==null){
				echo "NO HAY ADMINISTRACIONES PARA ESTE REISGO.";
			}else{
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
			}
			?>
		</tbody>
	</table>
</div>