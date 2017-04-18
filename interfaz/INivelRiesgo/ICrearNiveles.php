
<!DOCTYPE html>
<script>
	window.onload=ocultarBarra();

	 $( document ).ready(function(){
	   $('select').material_select();
	 });
</script>

	<div>
		<label class="white-text" for="divisiones">Cantidad de divisiones:</label>
		<select name="divisiones" id="divisiones" onchange="crearEliminarFilas()">
			<option value="0" disabled="true" selected >Seleccione un valor</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select>
	</div>

	<div class="row">
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
			<div id="div1">
				<table class="responsive-table centered bordered" id="tablaInsertarDivisiones">
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
		<input type="button" id="btnGuardar" value="Crear Niveles" class="btn btn-default" onclick="validarFormularioInsertar()"><br>
	</div>
	 