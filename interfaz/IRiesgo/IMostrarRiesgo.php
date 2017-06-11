<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
	<script type="text/javascript" src="../js/jsRiesgo.js"></script>

	<?php

		$idDepartamento=$_GET['id'];
	
		include("../../controladora/ctrListaRiesgo.php");
		$control=new ctrListaRiesgo;
		$listaRiesgos=$control->obtenerRiesgosDepartamento($idDepartamento);

		if(empty($listaRiesgos)){
		
			echo "<br><br><br><h3>No se han ingresado riesgos en este departamento.</h3>";
		}else{
		
?>

<script>
	window.onload=ocultarBarra();
</script>

	<div class="row">

		<div class="col l8 m8 s8">
				<h4>Lista de riesgos</h4>
		</div>
		<div class="input-field buscar1 col s12 m8 l8">
	        <label class="white-text" for="filtrar">Buscar</label>
	        <input id="datosRiesgos" type="text" >
    	</div>

    	<div class="col l4 m4 s4">
    		<div id="añadir">
    			<a id="boton" class="btn-floating tooltipped btn-large waves-effect waves-light red" data-tooltip="Agregar riesgos de versiones antiguas." style="float: right; margin-top: 22px;"><i class="material-icons" onclick="cargarPaginaAñadirRiesgo()">add</i></a>
    		</div>
		</div>

		<div class="col s12 m12 l12 scrollH">
			<div>
				<table class="responsive-table striped responsive2" id="MostrarRiesgos" >
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
							<th>Opcion 2</th>
						</tr>
					</thead>
					<tbody id="datosR" >
						<?php 
							foreach ($listaRiesgos as $riesgo){
								echo "<tr>					        
									<td>".$riesgo->getNombre()."</td>
									<td>".$riesgo->getDescripcion()."</td>
									<td>".$riesgo->getEstaActivo()."</td>
									<td> ‎"."₡".number_format($riesgo->getMontoEconomico(), 2, ',', ' ')."</td>
									<td>".$riesgo->getIdCategoria()."</td>
									<td>".$riesgo->getCausa()."</td>
									<td>".$riesgo->getFecha()."</td>
									<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"cargarPagina('../interfaz/IRiesgo/IModificarRiesgo.php?idRiesgo=".$riesgo->getId()."')\"/></td>
									<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" id=\"btnEliminarRiesgo\" onclick=\"confirmarModificacionEliminacion('".$riesgo->getId()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
								</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

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
	<?php  
				
		}
	?>
	<script>

  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	  		$('.tooltipped').tooltip({delay: 50});
	   	});
	</script>