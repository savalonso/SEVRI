<!DOCTYPE html>

<?php
	include ("../../Controladora/ctrListaAdministracion.php");
	include ("../../Controladora/ctrListaUsuario.php");
	$control = new ctrListaAdministracion;	
	$controlUsuarios = new ctrListaUsuario;
	$idAnalisis = $_GET['idAnalisis'];
	$lista =$control->obtenerAdministraciones($idAnalisis);	
	$listaUsuarios =$controlUsuarios->obtenerNomCedUsuarios();
	$listaMedidas = $control->obtenerMedidas();
	$fechaActual = date("Y-m-d");
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
							<th>Medida</th>
							<th>Actividad de tratamiento</th>
							<th>Indicador</th>
							<th>Plazo</th>
							<th>Monto Econ&oacutemico</th>
							<th>Responsable</th>
							<th>Opci&oacuten 1</th>
							<th>Opci&oacuten 2</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($lista==null){
							echo "A&uacuten no se ha realizado ninguna administraci&oacutens";
						}else{
							foreach ($lista as $administracion){
					            echo "<tr>				
						        	<td>".$administracion->getMedidaAdministracion()->getNombreMedida()."</td>
						        	<td>".$administracion->getActividadTratamiento()."</td>
						        	<td>".$administracion->getIndicador()."</td>
						        	<td>".$administracion->getPlazoTratamiento()."</td>
						        	<td>"."₡".number_format($administracion->getCostoActividad(), 2, ',', ' ')."</td>
						        	<td>".$administracion->getUsuario()->getNombre()."</td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"invocarDivModificarAdmi(this,'".$administracion->getId()."')\"/></td>
					        		<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarEliminarAdministracion('".$administracion->getId()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
					    		</tr>";
							}
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

	<!-- Aqui inicia el formulario para actualizar la administracion de un riesgo-->
	<div class="row " id="divModificarAdministracion" style="display:none">
		<form id="IModificarAdministrarRiesgo" method="Post" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<div>
					<label class="white-text" for="medida">Medida de Administraci&oacuten:</label>
					<select name="medida" id="medida">
						<option value="0" disabled="true" selected >Seleccione una medida</option>
						<?php 
						foreach ($listaMedidas as $medida){
							echo "<option value=".$medida->getId().">".$medida->getNombreMedida()."</option>";
						}
						?>
					</select>
				</div>
				 <div>
				 	<label class="white-text" for="actividad">Actividad de Tratamiento:</label>
					<textarea class="materialize-textarea" rows="10" cels="30" id="actividad" name="actividad" ></textarea>
				 </div>
				 <div>
				 	<label class="white-text" for="indicador">Indicador:</label>
					<textarea class="materialize-textarea" rows="10" cels="30" id="indicador" name="indicador" ></textarea>
				 </div>
				 <div>
				 	<label class="white-text" for="valor">Monto &eacuteconomico asociado a la actividad:</label>
					<input type="text" name="valor" id="valor" onkeyup="mascaraDinero(this)">
				 </div>
				 <div>
				 	<label class="white-text" for="plazo">Plazo de la Actividad:</label>
					<input type="date" name="plazo" id="plazo" value="<?php echo $fechaActual ?>" min="<?php echo $fechaActual; ?>" max="<?php echo date("Y")."-12-"."31"; ?>">
				</div>
				 <div>
				  	<label class="white-text" for="encargado">Seleccione el encargado de realizar la actividad:</label>
					<select name="encargado" id="encargado">
						<option value="0" disabled="true" selected>Seleccione un encargado</option>
						<?php 
						foreach ($listaUsuarios as $usuario){
							echo "<option value=".$usuario->getCedula().">".$usuario->getNombre()."</option>";
						}
						?>
					</select>
				 </div>
				<div>
					<?php 
						echo "<input type=\"hidden\" id=\"analisis\" name=\"analisis\"  value=\"".$idAnalisis."\"/>";
					 ?>
				</div>
				 <div>
					<input type="hidden" name="idAdmi" id="idAdmi">
					<button type="button" class="btnEliminar"><a class="waves-effect waves-light btn modal-trigger" href="#Mmodificar">Modificar</a></button>
					<input type="button" value="Canelar" class="btn btn-default" onclick="ocultarDivActualizar()"><br>
				</div>
			</div>
			<div id="Mmodificar" class="modal  blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				</div>
			</div>
		</form>
	</div>
	
	<!--Aqui termina el formulario de actualizar-->

	<!--  Modal para confirmar eliminación de la administracion -->

	<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idAdministracion" name="idAdministracion">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarAdministracion()" />
		</div>
	</div>

	
	<script>
	 $( document ).ready(function(){
		   $('select').material_select();
		 });

	$(document).ready(function() {
	    $("#IModificarAdministrarRiesgo").validate({
	        rules: {
	            medida: { required: true },
	            actividad: {  required: true, minlength: 20 , maxlength: 500 },
	            indicador: {  required: true, minlength: 5 , maxlength: 500 },
	           	plazo: {required: true,},
	           	encargado: { required: true }
	        },
	        messages: {
	            medida: "Debe seleccionar una medida de administraci&oacuten.",
	            actividad: "Debe introducir una actividad de tratamiento con un tamaño minimo de 20 caracteres y un maximo de 500 caracteres.",
	            indicador: "Debe introducir un descriptor con un tamaño minimo de 5 caracteres y un maximo de 500 caracteres.",
	            plazo: "Debe seleccionar una fecha limite en la que se debe realizar la actividad.",
	            encargado: "Debe seleccionar una persona que se encargue de realizar la actividad."

	        },
	        submitHandler: function(form){
	         if(document.getElementById('medida').value==0){
		        	Materialize.toast("Debe seleccionar una medida de administraci&oacuten.", 7000,'blue darken-3');
		     }else if(document.getElementById('encargado').value==0){
		        	Materialize.toast("Debe seleccionar una persona que se encargue de realizar la actividad", 7000,'blue darken-3');
		     }else{
		     	modificarAdministracion();
		     }
	        }
	    });
	});
	 
	 $( document ).ready(function(){
	   	$('.modal-trigger').leanModal();
	   	$('ul.tabs').tabs();
	});
  </script>	