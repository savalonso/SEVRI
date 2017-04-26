<!DOCTYPE html>
	<?php
		include_once ("../../Controladora/ctrDatosSevri.php");
		include_once ("../../Controladora/ctrListaAnalisis.php");
		$control = new ctrDatosSevri;
		$controlAnalisis = new ctrListaAnalisis;

		$idDepartamento=$_GET['id'];
	
		include("../../controladora/ctrListaRiesgo.php");
		$control=new ctrListaRiesgo;
		$listaRiesgos=$control->obtenerRiesgosDepartamento($idDepartamento);
		

	?>
	<script>
		window.onload=ocultarBarra();
	</script>			

	<div class="row">
		<h2>Lista de riesgos</h2>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
			<div id="div1">
			<?php  
				if($listaRiesgos!=null){
			?>
			<table class="responsive-table centered bordered">
				<thead>
					<tr>
							<th>Nombre</th>
							<th>Descripci&oacuten</th>
							<th>Estado</th>
							<th>Monto Econ&oacutemico</th>
							<th>Categor&iacutea</th>
							<th>Causa</th>
							<th>Fecha Registro</th>
							<th>Opcion 1</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if($listaRiesgos==null){
					echo "NO HAY REGISTROS A&Uacute;N";
				}else{
					foreach ($listaRiesgos as $riesgo){
						echo "<tr>
									<td>".$riesgo->getNombre()."</td>
						        	<td>".$riesgo->getDescripcion()."</td>
									<td>".$riesgo->getEstaActivo()."</td>
									<td> ‎"."₡".number_format($riesgo->getMontoEconomico(), 2, ',', ' ')."</td>
									<td>".$riesgo->getIdCategoria()."</td>
									<td>".$riesgo->getCausa()."</td>
									<td>".$riesgo->getFecha()."</td>
								<td><input class=\"btn btn-default\" type=\"button\" value=\"Analizar\" onclick=\"cargarPagina('../interfaz/IAnalisis/IAnalisisRiesgo.php?idRiesgo=".$riesgo->getId()."')\"/></td>
							</tr>";
					}
				}
				?>
				</tbody>
			</table>
		</div>
		<?php  
			}else{
				echo "<h3>A&uacuten no hay riesgos identificados</h3>";
			}
		?>	
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.modal-trigger').leanModal();
	});
</script>