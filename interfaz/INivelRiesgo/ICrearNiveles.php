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
?>
<!DOCTYPE html>
<script>
	window.onload=ocultarBarra();

	 $( document ).ready(function(){
	   $('select').material_select();
	 });
</script>
	
	<div class="row">
	<h4 class="col s12 m12 l12">Crear Niveles de Riesgo</h4>	
	<div class="col s12 m6 l6">
		<select name="divisiones" id="divisiones" onchange="crearEliminarFilas()">
			<option value="0" disabled="true" selected >Seleccione la cantidad de divisiones</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select>
	</div>

	
		<div class="col s12 m12 l12 ">
			<div id="div1">
				<table class="responsive-table striped" id="tablaInsertarDivisiones">
					<thead>
						<tr>
							<th>De</th>
							<th>A</th>
							<th>Descriptor</th>
							<th>Descripción</th>
							<th>Color</th>
						</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
	 
	<div>
		<input type="button" id="btnGuardar" name="btnGuardar" disabled value="Crear Niveles" class="btn btn-default" onclick="validarFormularioInsertar()"><br>
	</div>
	 