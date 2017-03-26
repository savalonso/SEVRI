<?php

session_start();
	if($_SESSION['tipo']=='Administrador'){
	$idCategoria = $_GET['idCategoria'];
	include ("../../data/dtCategoria.php");
	//include ("../../dominio/dRiesgo.php");
	$control = new dtCategoria;
	$lista = $control->getCategoria($idCategoria);
	foreach ($lista as $categoria) {
		$id = $categoria->getIdCategoria();
		$nombre = $categoria->getNombreCategoria();
		$descripcion = $categoria->getDescripcion();
		$hijoDe = $categoria->getHijoDe();	
	}

	include ("../../controladora/ctrDatosSevri.php");
	$control1 = new ctrDatosSevri;	
	$listaC =$control1->obtenerTodasLasCategorias();
	foreach ($listaC as $categorias) {
		$arr[] = array(
		'_id' => $categorias->getIdCategoria(),
        'nombre' => utf8_encode($categorias->getNombreCategoria()),
        'padre' => utf8_encode($categorias->getHijoDe()),
        'descripcion' => utf8_encode($categorias->getDescripcion())
    	); 	
	}
	$ArrayJson =json_encode($arr);
?>	
<script>
	window.onload=ocultarBarra();
</script>	
<div class="row">
	<form class="responsive" id="IModificarCategoria" method="Post" role="form">
		<div class="inputs blue darken-3 col s12 m6 l6 z-depth-5">
			<h3>Modificar Categor&iacutea</h3>
			<div >
				<label for="nombre">Nombre:</label><br>
				<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre";?>">
			</div>

			<div>
				<label for="descripcion">Descripci&oacuten:</label>
				<textarea class="materialize-textarea" rows="10" celds="30" id="descripcion" name="descripcion"><?php echo "$descripcion";?></textarea>
			</div>

			<div >
				<label  for="tipo">Tipo:</label></br></br>
				<select id="tipo" name="tipo" onchange="verificarCombo(this.value)"> 
				<?php
					if($hijoDe==0){
						echo"<option selected=\"true\" value=\"1\">Categor&iacutea</option>";
						echo"<option value=\"0\">Sub Categor&iacutea</option>";
					}else{
						echo"<option value=\"1\">Categor&iacutea</option>";
						echo"<option selected=\"true\" value=\"0\">Sub Categor&iacutea</option>";
					}
				?>
					
				</select>
			</div>
			
			<div>
				<label  class="white-text" for="categoria">Categor&iacutea:</label>
				<select id="categoria" name="categoria" disabled="true"> 
					<option disabled="true" selected="true" value="0">Seleccione una categor&iacutea...</option>
						<?php 
							foreach ($listaC as $categorias){
								if($categorias->getHijoDe()==0){
									echo "<option value=".$categorias->getIdCategoria()." >".$categorias->getNombreCategoria()."</option>";
								}
							}
						?>
				</select>
			</div>	

			<div >
				<input type="hidden" name="id" id="id" value="<?php echo "$idCategoria";?>">
			</div>
			<div>
				<input type="submit" value="Modificar" class="btn" ></br></br>
			</div>
		</div>
	</form>
</div>

<script>
	$( document ).ready(function(){
	   	$('select').material_select();

	   	var hijoDe = eval(<?php echo $hijoDe ?>);
	   	var id = eval(<?php echo $id ?>);
	   	var categorias = eval(<?php echo $ArrayJson ?>);
	   	if(hijoDe!=0){//si es una subcategoria
	   		//document.getElementById('categoria').disabled=false;
	   		for(i=0;i<categorias.length;i++){
          		 if(categorias[i]._id == hijoDe){
                	document.getElementById("categoria").options[document.getElementById("categoria").options.length]=
                	new Option(categorias[i].nombre,categorias[i]._id);
           		}
           		document.getElementById("categoria").disabled=false;
       		}
	   	}
	});
	$(document).ready(function() {
		if(document.getElementById('categoria').disabled==false){
			$("#IModificarCategoria").validate({
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
		        		modificarCategoria();
		        	}
		        }
		    });
		}else{
			$("#IModificarCategoria").validate({
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
		        	modificarCategoria();
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