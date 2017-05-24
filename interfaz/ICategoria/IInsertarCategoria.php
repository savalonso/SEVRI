<!DOCTYPE html>
<?php 
	session_start();
	if($_SESSION['tipo']=='Administrador'){
 ?>
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
						<textarea class="materialize-textarea" rows="10" celds="30" id="descripcion" name="descripcion" ></textarea>
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
	$( document ).ready(function(){
	   $('select').material_select();
	   Materialize.updateTextFields();
	});
	$(document).ready(function() {
		if(document.getElementById('categoria').disabled==false){
			$("#IInsertarCategoria").validate({
		        rules: {
		            nombre: { required: true,minlength: 10, maxlength: 500},
		            descripcion: { required:true,minlength: 20, maxlength: 2000},
		            tipo: {required : true},
		        },
		        messages: {
		            nombre: "Debe introducir un nombre de categor&iacutea mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten de categor&iacutea mayor de 20 car&aacutecteres.",
		            tipo: "Debe seleccionar un tipo.",
		        },
		        submitHandler: function(form){
		        	if(document.getElementById('categoria').value==0){
		        		Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		insertarCategoria();
		        	}
		        }
		    });
		}else{
			$("#IInsertarCategoria").validate({
		        rules: {
		            nombre: { required: true,minlength: 10, maxlength: 500},
		            descripcion: { required:true,minlength: 20, maxlength: 2000},
		            tipo: {required : true},
		            categoria: {required: true},
		        },
		        messages: {
		            nombre: "Debe introducir un nombre de categor&iacutea mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten de categor&iacutea mayor de 20 car&aacutecteres.",
		            tipo: "Debe seleccionar un tipo.",
		            categoria: "Debe seleccionar una sub categor&iacutea.",
		        },
		        submitHandler: function(form){
		        	insertarCategoria();
		        }
		    });
		}
	});
	function verificarCombo(valor){
		if(valor==0){
			document.getElementById('categoria').disabled=false;
		}else{
			document.getElementById('categoria').disabled=true;
		}
		$('select').material_select();
	}
</script>

<?php }else{

	header("location:../../loginUsuarios.php");
	}  ?>
</html>

