<!DOCTYPE html>
<html lang="en">
<head>
	<title>A&ntilde;adir riesgo</title>
	<meta charset="UTF-8">
</head>
<body>
	<?php
		$idRiesgo = $_GET['idRiesgo'];
		include ("../../data/dtRiesgo.php");
		$controlR = new dtRiesgo;
		$listaR = $controlR->getRiesgo($idRiesgo);
		foreach ($listaR as $riesgo) {
			$id = $riesgo->getId();
			$idDepartamento = $riesgo->getIdDepartamento();
			$nombre = $riesgo->getNombre();
			$descripcion = $riesgo->getDescripcion();
			$monto = $riesgo->getMontoEconomico();
			$causa = $riesgo->getCausa();
			$subcategoria = $riesgo->getIdCategoria();
			$estado = $riesgo->getEstaActivo();
		}

		include ("../../Controladora/ctrDatosSevri.php");
		$control = new ctrDatosSevri;	
		$lista =$control->obtenerTodasLasCategorias();	
		
		foreach ($lista as $categoria){
			$arr[] = array(
			'_id' => $categoria->getIdCategoria(),
            'nombre'=> utf8_encode($categoria->getNombreCategoria()),
            'padre' => utf8_encode($categoria->getHijoDe()),
            'descripcion' => utf8_encode($categoria->getDescripcion())
        	); 	
		}
		$ArrayJson =json_encode($arr);
	?>
	<script>
	window.onload=ocultarBarra();
	</script>
	
		<div class="row">
			<form id="IIdentificarRiesgo" method="Post" role="form" class="responsive">
				<div class="inputs blue darken-3 col s8 m6 l6 z-depth-5">
					<h3>A&ntilde;adir riesgo</h3>
					<div >
						<label class="white-text" for="nombre">Nombre:</label>
						<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre"; ?>">
					</div>

					<div >
						<label class="white-text" for="descripcion">Descripci&oacuten:</label>
						<textarea class="materialize-textarea" rows="10" celds="30" id="descripcion" name="descripcion"><?php echo "$descripcion"; ?></textarea>
					</div>

					<div>
						<label class="white-text" for="estado">Estado:</label>
						<select id="estado" name="estado"> 
							<option value="1">Activo</option>
							<option value="0">Inactivo</option>
						</select>
					</div>

					<div >
						<label class="white-text" for="monto">Monto Econ&oacutemico:</label>
						<input type="text" name="monto" id="monto" onkeyup="format(this)">
					</div>
							
					<div>
						<label  class="white-text" for="categoria">Categor&iacutea:</label>
						<select id="categoria" name="categoria" onchange="llenarSelect2(this.value)"> 
							<option disabled="true" selected="true" value="0">Seleccione una categor&iacutea...</option>
							<?php 
								foreach ($lista as $categoria){
									if($categoria->getHijoDe()=="0"){
										echo "<option value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
									}
								}
							?>
						</select>
					</div>
					<div>
						<label  class="white-text" for="subcategoria">Sub Categor&iacuteas:</label>
						<select id="subcategoria" name="subcategoria" onchange="mostrarSubcategoria(this.value)"> 
							<option disabled="true" selected="true" value="0">Seleccione una sub categor&iacutea...</option>
						</select>
					</div>

					<div >
						<label class="white-text" for="causa">Causa:</label>
						<textarea class="materialize-textarea" rows="10" cels="30" id="causa" name="causa" ></textarea>
					</div>
							
					<div >
						<input data-tooltip="I am tooltip" type="submit" value="A&ntilde;adir" class="btn tooltipped" ></br></br>
					</div>
				</div>
			</form>
			<div id="divContenedorM" class="divContenedorM col s4 m6 l6">
				<div id="divMsjCategoria" class="divMsjCategoria">
					<div id="msjCategoria" class="msjCategoria" style="display:none;"></div>
				</div>
				<div id="divMsjSubCategoria" class="divMsjSubCategoria">
					<div id="msjSubCategoria" class="msjSubCategoria" style="display:none;"></div>
				</div>
			</div>
		</div>
</body>
<script>
	$( document ).ready(function(){
	   $('select').material_select();
	   Materialize.updateTextFields();
	   $('.tooltipped').tooltip({delay: 50});
	});
	$(document).ready(function() {
		if(document.getElementById('subcategoria').disabled==true){
			$("#IIdentificarRiesgo").validate({
		        rules: {
		            nombre: { required: true,minlength: 10, maxlength: 100},
		            descripcion: { required:true,minlength: 20, maxlength: 3000},
		            estado: {required : true},
		            monto: {required: true, maxlength: 15,minlength: 6},
		            categoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000}
		        },
		        messages: {
		            nombre: "Debe introducir un nombre al riesgo mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten al riesgo mayor de 20 car&aacutecteres.",
		            estado: "Debe seleccionar un estado.",
		            monto: "Debe introducir un monto mayor a 3 d&iacutegitos y no mayor de 11.",
		            categoria: "Debe seleccionar una categor&iacutea.",
		            causa: "Debe introducir una causa mayor a 20 car&aacutecteres y un maximo de 2000.",
		        },
		        submitHandler: function(form){
		        	if(document.getElementById('categoria').value==0){
		        		Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		insertarRiesgo();
		        	}
		        }
		    });
		}else{
			$("#IIdentificarRiesgo").validate({
		        rules: {
		            nombre: { required: true,minlength: 10, maxlength: 100},
		            descripcion: { required:true,minlength: 20, maxlength: 3000},
		            estado: {required : true},
		            monto: {required: true,minlength: 6, maxlength: 15},
		            subcategoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000}
		        },
		        messages: {
		            nombre: "Debe introducir un nombre al riesgo mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten al riesgo mayor de 20 car&aacutecteres.",
		            estado: "Debe seleccionar un estado.",
		            monto: "Debe introducir un monto mayor a 3 d&iacutegitos y no mayor de 11.",
		            subcategoria: "Debe seleccionar una sub categor&iacutea.",
		            causa: "Debe introducir una causa mayor a 20 car&aacutecteres y un maximo de 2000.",
		        },
		        submitHandler: function(form){
		           if(document.getElementById('categoria').value==0){
		        		Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		insertarRiesgo();
		        	}
		        }
		    });
		}
	});
	function llenarSelect2(valor){
		var categorias = eval(<?php echo $ArrayJson ?>);
		if(valor == 0){
			document.getElementById("subcategoria").options.length=0;
			document.getElementById("subcategoria").disabled=true;
		}else{
			document.getElementById("subcategoria").options.length=0;
			 for(i=0;i<categorias.length;i++){
          		 if(categorias[i].padre == valor){
                	document.getElementById("subcategoria").options[document.getElementById("subcategoria").options.length]=
                	new Option(categorias[i].nombre,categorias[i]._id);
           		}
           		document.getElementById("subcategoria").disabled=false;
       		}
		}
		$('select').material_select();

		if(valor==0){
			$("#msjCategoria").hide();
		}else{
			$("#msjCategoria").show();
			setTimeout(function() {
				$("#msjCategoria").fadeOut(5);
			},5000);
		}
		var categorias = eval(<?php echo $ArrayJson ?>);
		for (i=0;i<categorias.length;i++) {
			if(categorias[i]._id==valor){
				document.getElementById('msjCategoria').innerHTML = categorias[i].descripcion;
			}
		}
	}
	function format(input){
		var num = input.value.replace(/\./g,'');
		input.value = num;
		num = input.value.replace(/\₡/g,'');
		if(!isNaN(num)){
			num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split('').reverse().join('').replace(/^[\.]/,'');
			num = num.replace(/\./g,'.');
			input.value ='₡'+num;
		}else{ 
			input.value = input.value.replace(/[^\d\.]*/g,'');
		}
	}
	function mostrarSubcategoria(id){
		if(id==0){
			$("#msjSubCategoria").hide();
		}else{
			$("#msjSubCategoria").show();
			setTimeout(function() {
				$("#msjSubCategoria").fadeOut(5);
			},5000);
		}
		var categorias = eval(<?php echo $ArrayJson ?>);
		for (i=0;i<categorias.length;i++) {
			if(categorias[i]._id==id){
				document.getElementById('msjSubCategoria').innerHTML = categorias[i].descripcion;
			}
		}
	}
</script>
</html>