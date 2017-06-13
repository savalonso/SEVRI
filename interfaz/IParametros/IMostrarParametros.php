<!DOCTYPE html>
<?php
		session_start();
	    $tipo="";
	    if(isset($_SESSION['tipo'])){
	        $tipo=$_SESSION['tipo'];
	    }else{
	        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	    }
	    if($tipo!='Administrador'){
	        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	    }
		include ("../../controladora/ctrListaParametro.php");
		$control = new ctrListaParametro;	
		$lista = $control->mostrarParametros();	
		$TempProbabilidad = false;
		$TempImpacto=false;
		$TempCalificacion=false;
		if($lista != null){
			foreach ($lista as $parametro) {
				if($parametro->getNombreParametro() == "Impacto"){
					$TempImpacto=true;
				}else if($parametro->getNombreParametro() == "Probabilidad"){
					$TempProbabilidad = true;
				}else if($parametro->getNombreParametro() == "Calificacion"){
				 	$TempCalificacion=true;
				}
			}
		}
	?>
	<script>
		window.onload=ocultarBarra();
		$( document ).ready(function(){
	   	$('select').material_select();
	   	});
	</script>

	<div class="row indicator">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab s4"><a href="#contenedorImpacto">Par&aacutemetros Impacto</a></li>
				<li class="tab s4"><a href="#contenedorProbabilidad">Par&aacutemetros Probabilidad</a></li>
				<li class="tab s4"><a href="#contenedorCalificacion">Calificaci&oacuten Medida</a></li>
			</ul>
		</div>
	</div>	

	<!-- Parametros de Impacto -->

	<div id="contenedorImpacto">
		<div class="row">
			<?php  
				if($lista!=null && $TempImpacto == true ){
			?>
			<div class="row">
				<h4 class="col s12 m8 l8">Par&aacutemetros de Impacto</h4>
				<div class="col s4 m4 l4">
					<a id="boton" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php');ocultarTooltip();" data-tooltip="Crear Parámetro" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" style="float: right;"><i class="material-icons">add</i></a>
				</div>
			</div>
			<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="buscarParametroImpacto" type="text" >
        	</div>
			<div class="col s12 m12 l12 scrollH" >
				<div >
					<table class="responsive-table striped responsive2 " id="impacto">
						<thead>
							<tr>
								<th>Tipo de Par&aacutemetro</th>
								<th>Valor</th>
								<th>Descriptor</th>
								<th>Descripci&oacuten</th>
								<th>color</th>
								<th>Modificar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody id="buscarImpacto">
							<?php 
								foreach ($lista as $parametro){
									if($parametro->getNombreParametro() == "Impacto"){
							            echo "<tr>					        
								        	<td>".$parametro->getNombreParametro()."</td>
								        	<td>".$parametro->getValorParametro()."</td>
											<td>".$parametro->getDescriptorParametro()."</td>
											<td>".$parametro->getDescripcionParametro()."</td>
											<td><input class=\"btn btn-default\" type=\"button\" style=\"background-color:".$parametro->getColorParametro()."\"/></td>";
											if($parametro->getEsModificable() == true){
												echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"invocarDivModificar(this,'".$parametro->getIdParametro()."','".$parametro->getColorParametro()."')\"/></td>
							        				<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarEliminacion('".$parametro->getIdParametro()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
							    					</tr>";
											}else{
												echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>
							        				<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
							    					</tr>";
											}
						    		}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php  
				}else{ ?>
					<div class="row">
						<h4 class="col s12 m8 l8">No se han creado par&aacutemetros de impacto</h4>
						<div class="col s4 m4 l4">
							<a id="boton" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php');ocultarTooltip();" data-tooltip="Crear Parámetro" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
						</div>
					</div>
			<?php } ?>
		</div>
	</div>

	<!-- Parametros de Probabilidad -->

	<div id="contenedorProbabilidad">
		<div class="row">
			<?php  
				if($lista!=null && $TempProbabilidad == true){
			?>
			<div class="row">
				<h4 class="col s12 m8 l8">Par&aacutemetros de probabilidad</h4>
				<div class="col s4 m4 l4">
					<a id="boton" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php');ocultarTooltip();" data-tooltip="Crear Parámetro" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" style="float: right;"><i class="material-icons">add</i></a>
				</div>
			</div >
			<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="buscarParametroProbabilidad" type="text" >
        	</div>
			<div class="col s12 m12 l12" >
				<div class="scrollH">
					<table class="responsive-table striped responsive2" id="probabilidad">
						<thead>
							<tr>
								<th>Tipo de Par&aacutemetro</th>
								<th>Valor</th>
								<th>Descriptor</th>
								<th>Descripci&oacuten</th>
								<th>color</th>
								<th>Modificar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody id="buscarP1">
							<?php 
								foreach ($lista as $parametro){
									if($parametro->getNombreParametro() == "Probabilidad"){
							            echo "<tr>					        
								        	<td>".$parametro->getNombreParametro()."</td>
								        	<td>".$parametro->getValorParametro()."</td>
											<td>".$parametro->getDescriptorParametro()."</td>
											<td>".$parametro->getDescripcionParametro()."</td>
											<td><input class=\"btn btn-default\" type=\"button\" style=\"background-color:".$parametro->getColorParametro()."\"/></td>";
							        		if($parametro->getEsModificable() == true){
												echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"invocarDivModificar(this,'".$parametro->getIdParametro()."','".$parametro->getColorParametro()."')\"/></td>
							        				<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarEliminacion('".$parametro->getIdParametro()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
							    					</tr>";
											}else{
												echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>
							        				<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
							    					</tr>";
											}
						    		}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php  
				}else{ ?>
					<div class="row">
						<h4 class="col s12 m8 l8">No se han creado par&aacutemetros de probabilidad</h4>
						<div class="col s4 m4 l4">
							<a id="boton" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php');ocultarTooltip();" data-tooltip="Crear Parámetro" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" style="float: right;"><i class="material-icons">add</i></a>
						</div>
					</div>
			<?php } ?>
		</div>
	</div>

	<!-- Parametros de calificacion Medida -->

	<div id="contenedorCalificacion">
		<div class="row">
			<?php  
				if($lista!=null && $TempCalificacion==true){
			?>
			<div class="row">
				<h4 class="col s12 m8 l8">Par&aacutemetros de calificaci&oacuten de la medida</h4>
				<div class="col s4 m4 l4" >
					<a id="boton" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php');ocultarTooltip();" data-tooltip="Crear Parámetro" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" style="float: right;"><i class="material-icons">add</i></a>
				</div>
			</div>
			<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="buscarCalificacionMedida" type="text" >
        	</div>
			<div class="col s12 m12 l12 scrollH ">
				<div>
					<table class="responsive-table striped responsive2" id="calificacion">
						<thead>
							<tr>
								<th>Tipo de Par&aacutemetro</th>
								<th>Valor</th>
								<th>Descriptor</th>
								<th>Descripci&oacuten</th>
								<th>color</th>
								<th>Modificar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody id="buscarCalificacion">
							<?php 
								foreach ($lista as $parametro){
									if($parametro->getNombreParametro() == "Calificacion"){
							            echo "<tr>					        
								        	<td>".$parametro->getNombreParametro()."</td>
								        	<td>".$parametro->getValorParametro()."</td>
											<td>".$parametro->getDescriptorParametro()."</td>
											<td>".$parametro->getDescripcionParametro()."</td>
											<td><input class=\"btn btn-default\" type=\"button\" style=\"background-color:".$parametro->getColorParametro()."\"/></td>";
							        		if($parametro->getEsModificable() == true){
												echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"invocarDivModificar(this,'".$parametro->getIdParametro()."','".$parametro->getColorParametro()."')\"/></td>
							        				<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarEliminacion('".$parametro->getIdParametro()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
							    					</tr>";
											}else{
												echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>
							        				<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
							    					</tr>";
											}
						    		}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php  
				}else{ ?>
					<div class="row">
						<h4 class="col s12 m8 l8">No se han creado par&aacutemetros de calificaci&oacuten de la medida</h4>
						<div class="col s4 m4 l4">
							<a id="boton" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php');ocultarTooltip();" data-tooltip="Crear Parámetro" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" style="float: right;"><i class="material-icons">add</i></a>
						</div>
					</div>
			<?php } ?>
			
		</div>
	</div>

	<!--  Modal para confirmar eliminación de parametro -->

	<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idParametro" name="idParametro">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarParametro()" />
		</div>
	</div>

	<!--  Aquí Comienza el formulario para modificar un parametro  -->

<div class="row " id="divModificarParametros" style="display:none">
		<form id="modificarParametro" method="Post" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<div>
					<label class="white-text" for="Tparametro">Tipo de parametro:</label>
					<select name="Tparametro" id="Tparametro">
						<option value="0" disabled="true" >Seleccione una opci&oacuten</option>
						<option value="1">Probabilidad</option>
						<option value="2">Impacto</option>
						<option value="3">Calificaci&oacuten de la medida</option>
					</select>
				</div>
				 <div>
				 	<label class="white-text" for="fecha">Descriptor:</label>
					<input type="text" name="descriptor" id="descriptor">
				</div>
				 <div>
				 	<label class="white-text" for="descripcion">Descripci&oacuten:</label>
					<textarea class="materialize-textarea" rows="10" cels="30" id="descripcion" name="descripcion" ></textarea>
				 </div>
				 <div>
				 	<label class="white-text" for="valor">Valor:</label>
					<input type="number" name="valor" id="valor" onkeyup="validarNumero(this)">
				 </div>
				 <div>
				  	<label class="white-text" for="color">Color:</label>
					<select name="color" id="color" onchange="cambiarColor(this.value)">
						<option value="0" disabled="true" >Seleccione un color</option>
						<option value="#009900">Verde Oscuro</option>
						<option value="#00cc00">Verde Claro</option>
						<option value="#ff6600">Anaranjado</option>
						<option value="#ffcc00">Amarillo</option>
						<option value="#e60000">Rojo</option>
					</select>
					<div id="divColor" class="paletaColores">
						
					</div>
				 </div>
				<div>
					<input type="hidden" name="idParametro" id="idParametro">
					<a id="btnModificarParametro" class="waves-effect waves-light btn modal-trigger" href="#Mmodificar">Modificar</a>
					<input type="button" value="Canelar" class="btn btn-default" onclick="ocultarDiv()"><br>
				</div>
			</div><br>

			<!-- Se crea el modal para preguntar si se desea modificar el parametro  -->
			<div id="Mmodificar" class="modal  blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="submit" value="Confirmar" id="btnModificarParametro" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				</div>
			</div>
		</form>
	</div>

	<!-- Validacion para el formulario -->

<script>
	$(document).ready(function() {
	    $("#modificarParametro").validate({
	        rules: {
	            Tparametro: { required: true },
	            descriptor: {  required: true, minlength: 4 , maxlength: 20 },
	            descripcion: {  required: true, minlength: 20 , maxlength: 1000 },
	           	valor: {required: true, maxlength: 1 },
	           	color: { required: true }
	        },
	        messages: {
	            Tparametro: "Debe seleccionar el tipo de parametro.",
	            descriptor: "Debe introducir un descriptor con un tamaño minimo de 4 caracteres y un maximo de 20 caracteres.",
	            descripcion: "Debe introducir un descripcion con un tamaño minimo de 20 caracteres y un maximo de 1000 caracteres.",
	            valor: "Debe introducir un valor numerico que solo represente un caracter y que sea mayor que 0.",
	            color: "Debe seleccionar el color del parametro."

	        },
	        submitHandler: function(form){
	         if(document.getElementById('Tparametro').value==0){
		        	Materialize.toast("Debe seleccionar un tipo de parametro", 7000,'blue darken-3');
		     }else if(document.getElementById('color').value==0){
		        	Materialize.toast("Debe seleccionar el color del parametro", 7000,'blue darken-3');
		     }else{
		     	modificarParametro();
		     }
	           
	        }
	    });
	});
	 
	 $( document ).ready(function(){
	   	$('.modal-trigger').leanModal();
	   	$('ul.tabs').tabs();
	});
  </script>	
	<script type="text/javascript" src="../js/jsParametros.js"></script>			