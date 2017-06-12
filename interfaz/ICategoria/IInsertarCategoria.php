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
<html lang="en">
<head>
	<title>Insertar Categor&iacutea</title>
	<meta charset="UTF-8">
</head>
<body>
	<?php
		include ("../../Controladora/ctrDatosSevri.php");
		$control = new ctrDatosSevri;	
		$lista =$control->obtenerTodasLasCategorias();	
		
		if($lista!=null){
			foreach ($lista as $categoria){
				$arr[] = array(
				'_id' => $categoria->getIdCategoria(),
	            'nombre'=> utf8_encode($categoria->getNombreCategoria()),
	            'padre' => utf8_encode($categoria->getHijoDe()),
	            'descripcion' => utf8_encode($categoria->getDescripcion())
	        	); 	
			}
			$ArrayJson =json_encode($arr);
		}
	?>
	<script>
	window.onload=ocultarBarra();
	</script>
	
		<div class="row">
			<form id="IInsertarCategoria" method="Post" role="form" class="responsive">
				<div class="inputs blue darken-3 col s8 m6 l6 z-depth-5">
					<h3>Insertar Categor&iacutea</h3>
					<div >
						<label class="white-text" for="nombre">Nombre:</label>
						<input type="text" name="nombre" id="nombre">
					</div>

					<div >
						<label class="white-text" for="descripcion">Descripci&oacuten:</label>
						<textarea class="materialize-textarea scrollTextArea" rows="10" celds="30" id="descripcion" name="descripcion" ></textarea>
					</div>

					<div>
						<label class="white-text" for="tipo">Tipo:</label>
						<select id="tipo" name="tipo" onchange="verificarCombo(this.value)">
							<?php 
							if($lista!=null){
								echo "<option value=\"1\">Categor&iacutea</option>";
								echo "<option value=\"0\">Sub Categor&iacutea</option>";
							}else{
								echo "<option value=\"1\">Categor&iacutea</option>";
								echo "<option disabled=\"true\" value=\"0\">Sub Categor&iacutea</option>";
							}
							?>
						</select>
					</div>
		
					<div>
						<label  class="white-text" for="categoria">Categor&iacutea:</label>
						<select id="categoria" name="categoria" disabled="true">
							<?php 
							if($lista!=null){
								echo "<option disabled=\"true\" selected=\"true\" value=\"0\">Seleccione una categor&iacutea...</option>";
								foreach ($lista as $categoria){
									if($categoria->getHijoDe()=="0"){
										echo "<option value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
									}
								}
							}else{
								echo "<option disabled=\"true\" selected=\"true\" value=\"0\">No hay categor&iacuteas disponibles</option>";
							}
							?>
						</select>
					</div>
							
					<div>
						<input type="submit" value="Crear" class="btn" ></br></br>
					</div>
				</div>
			</form>
		</div>
</body>
<script>
var statSend = false;
	$( document ).ready(function(){
	   $('select').material_select();
	   Materialize.updateTextFields();
	   validarInsertarCategoria();
	});
	function verificarCombo(valor){
		if(valor==0){
			document.getElementById('categoria').disabled=false;
		}else{
			document.getElementById('categoria').disabled=true;
		}
		$('select').material_select();
		validarInsertarCategoria();
	}
</script>
</html>