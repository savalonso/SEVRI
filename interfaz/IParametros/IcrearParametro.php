<script></script>
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
	<script>
		 window.onload=ocultarBarra();

		 $( document ).ready(function(){
		   $('select').material_select();
		 });
	</script>
	<div class="row">
		<h4 class="col s12 m8 l8">Crear Par&aacutemetros</h4>
	</div>
	<div class="row ">
		<form id="IcrearParametros" method="Post" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<div>
					<label class="white-text" for="Tparametro">Tipo de par&aacutemetro:</label>
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
					<textarea class="materialize-textarea scrollTextArea" cols="10" rows="8" id="descripcion" name="descripcion" ></textarea>
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
					<input type="submit" value="Insertar" id="btnInsertarParametro" class="btnAccionCrud btn btn-default"><br>
				</div>
				 
				
				
			</div>
		</form>
	</div>
	<script type="text/javascript" src="../js/jsParametros.js"></script>

