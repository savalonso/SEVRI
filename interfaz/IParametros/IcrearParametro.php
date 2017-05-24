
	<script>
		 window.onload=ocultarBarra();

		 $( document ).ready(function(){
		   $('select').material_select();
		 });
	</script>

	<div class="row ">
		<form id="IcrearParametros" method="Post" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<div>
					<label class="white-text" for="Tparametro">Tipo de parametro:</label>
					<select name="Tparametro" id="Tparametro">
						<option value="0" disabled="true" selected >Seleccione una opci&oacuten</option>
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
						<option value="0" disabled="true" selected>Seleccione un color</option>
						<option value="#009900">Verde Oscuro</option>
						<option value="#00cc00">Verde Claro</option>
						<option value="#ff6600">Anaranjado</option>
						<option value="#ffcc00">Amarillo</option>
						<option value="#e60000">Rojo</option>
					</select>
					<div id="divColor" class="paletaColores"></div>
				 </div>
				<div>
					<input type="submit" value="Crear" class="btn btn-default"><br>
				</div>
				 
				
				
			</div>
		</form>
	</div>
<script>
	$(document).ready(function() {
	    $("#IcrearParametros").validate({
	        rules: {
	            Tparametro: { required: true },
	            descriptor: {  required: true, minlength: 4 , maxlength: 20 },
	            descripcion: {  required: true, minlength: 20 , maxlength: 1000 },
	           	valor: {required: true, maxlength: 1, minlength: 1},
	           	color: { required: true }
	        },
	        messages: {
	            Tparametro: "Debe seleccionar el tipo de parametro.",
	            descriptor: "Debe introducir un descriptor con un tamaño minimo de 4 caracteres y un maximo de 20 caracteres.",
	            descripcion: "Debe introducir un descripcion con un tamaño minimo de 20 caracteres y un maximo de 1000 caracteres.",
	            valor: "Debe introducir un valor numerico que solo represente un caracter y que sea mayor a 0.",
	            color: "Debe seleccionar el color del parametro."

	        },
	        submitHandler: function(form){
	         if(document.getElementById('Tparametro').value==0){
		        	Materialize.toast("Debe seleccionar un tipo de parametro", 7000,'blue darken-3');
		     }else if(document.getElementById('color').value==0){
		        	Materialize.toast("Debe seleccionar el color del parametro", 7000,'blue darken-3');
		     }else{
		     	insertarParametros();
		     }
	           
	        }
	    });
	});
	 
  </script>
