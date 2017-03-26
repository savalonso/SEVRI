<!DOCTYPE html>
	<?php
		include ("../../Controladora/ctrDatosSevri.php");
		$control = new ctrDatosSevri;	
		$lista =$control->obtenerRiesgos();	
	?>
	<script>
		window.onload=ocultarBarra();
	</script>			

	<div class="row">
		<h2>Lista de riesgos</h2>
		<a href="#" onclick="cargarPagina('../interfaz/IRiesgo/IAnadirRiesgo.php')" data-tooltip="Agregar riesgos de versiones antiguas." class="btn-floating tooltipped btn-large waves-effect waves-light red "><i class="material-icons">add</i></a>
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
							<th>Departamento</th>
							<th>Estado</th>
							<th>Monto Econ&oacutemico</th>
							<th>Categor&iacutea</th>
							<th>Causa</th>
							<th>Fecha Registro</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($lista==null){
							echo "NO HAY REGISTROS AUN";
						}else{
							foreach ($lista as $riesgo){
					            echo "<tr>					        
						        	<td>".$riesgo->getNombre()."</td>
						        	<td>".$riesgo->getDescripcion()."</td>
									<td>".$riesgo->getIdDepartamento()."</td>
									<td>".$riesgo->getEstaActivo()."</td>
									<td> ‎"."₡".number_format($riesgo->getMontoEconomico(), 2, ',', ' ')."</td>
									<td>".$riesgo->getIdCategoria()."</td>
									<td>".$riesgo->getCausa()."</td>
									<td>".$riesgo->getFecha()."</td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"		cargarPagina('../interfaz/IRiesgo/IModificarRiesgo.php?idRiesgo=".$riesgo->getId()."')\"/></td>
					        		<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacion('".$riesgo->getId()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
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
				<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
		 		    <div class="modal-content">
					    <h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
					 </div>
					 <div class="modal-footer blue darken-3 z-depth-5">
					 	<input type="hidden" id="idRiesgo" name="idRiesgo">
					 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
					 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarRiesgo()"/>
				     </div>
	 			</div>
		</div>
	</div>

	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	  		$('.tooltipped').tooltip({delay: 50});
	   	});
	</script>