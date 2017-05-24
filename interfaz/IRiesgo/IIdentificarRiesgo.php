<!DOCTYPE html>
<html lang="en">
<head>
	<title>Identificacion</title>
	<meta charset="UTF-8">
</head>
<body>

	<script>
	window.onload=ocultarBarra();
	</script>

	<?php 
		session_start();
		$cedula=$_SESSION['idUsuario'];
		include("../../controladora/ctrListaDepartamento.php");
		include ("../../controladora/ctrDatosSevri.php");
		$controlDepartamentos=new ctrListaDepartamento;
		$controlSevriCategorias = new ctrDatosSevri;
		$listaDepartamentos=$controlDepartamentos->obtenerListaDepartamentosUsuario($cedula);
		$listaCategorias =$controlSevriCategorias->obtenerTodasLasCategorias();	
		
		if(empty($listaDepartamentos) && empty($listaCategorias)){
			echo "<br><h3>No se puede realizar este proceso porque no hay categorias asociadas a la version del SEVRI y usted no ha sido agregado a un departamento.</h3>";
			
		}else if(empty($listaDepartamentos)){
			echo "<br><h3>No se puede realizar este proceso porque usted no ha sido agregado a un departamento.</h3>";
		}else if(empty($listaCategorias)){
			echo "<br><h3>No se puede realizar este proceso porque no hay categorias asociadas a la version del SEVRI.</h3>";
				
		}
		else{

			foreach($listaDepartamentos as $departamento) {
				$arrayDepartamento[]=array(
					'idDepartamento'=>$departamento->getIdDepartamento(),
					'codigoDepartamento'=>utf8_encode($departamento->getCodigoDepartamento()),
					'nombreDepartamento'=>utf8_encode($departamento->getNombreDepartamento())
				);
			}

			$arrayJsonDepartamentos=json_encode($arrayDepartamento);

			foreach ($listaCategorias as $categoria){
				$arr[] = array(
				'_id' => $categoria->getIdCategoria(),
            	'nombre'=> utf8_encode($categoria->getNombreCategoria()),
            	'padre' => utf8_encode($categoria->getHijoDe()),
            	'descripcion' => utf8_encode($categoria->getDescripcion())
        		); 	
			}
			$ArrayJson =json_encode($arr);?>
	

	
		<div class="row">

				<form id="IIdentificarRiesgo" method="Post" role="form" class="responsive">
					<div class="inputs blue darken-3 col s8 m6 l6 z-depth-5">
						<h3>Identificaci&oacuten</h3>

						<div class="">

                			<label  for="Tipo">Departamentos:</label>
               				 <select id="departamentoUsuario" name="departamentoUsuario" onchange="cargarDepartamentos()">
								
								<?php
									foreach ($listaDepartamentos as $departamento):?> {
									
										<option value="<?php echo $departamento->getIdDepartamento();?>"><?php echo $departamento->getNombreDepartamento();?></option>;
										<?php endforeach ?>
									}

							 	?>
                    		
							</select>

            			</div>	
					
						<div id="temporal" style="display:none">
						
							<div >
								<label class="white-text" for="nombre">Nombre:</label>
								<input type="text" name="nombre" id="nombre">
							</div>

							<div >
								<label class="white-text" for="descripcion">Descripci&oacuten:</label>
								<textarea class="materialize-textarea" rows="10" celds="30" id="descripcion" name="descripcion" ></textarea>
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
										foreach ($listaCategorias as $categoria){
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
								<input type="submit" value="Crear" class="btn btn-default"></br></br>
							</div>

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

		<?php
				}
		  ?>

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
		            monto: {minlength: 1,maxlength: 15},
		            categoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000}
		        },
		        messages: {
		            nombre: "Debe introducir un nombre al riesgo mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten al riesgo mayor de 20 car&aacutecteres.",
		            estado: "Debe seleccionar un estado.",
		            monto: "Debe introducir un monto mayor a 1 d&iacutegito y un maximo de 15 d&iacutegitos.",
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
		            monto: {minlength: 1,maxlength: 15},
		            subcategoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000}
		        },
		        messages: {
		            nombre: "Debe introducir un nombre al riesgo mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten al riesgo mayor de 20 car&aacutecteres.",
		            estado: "Debe seleccionar un estado.",
		            monto: "Debe introducir un monto mayor a 1 d&iacutegito y un maximo de 15 d&iacutegitos.",
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

	function cargarDepartamentos(){

		document.getElementById("temporal").style.display = 'block';
		var departamentos= eval(<?php echo $arrayJsonDepartamentos?> );

		for (i=0; i<departamentos.length; i++) {

			new Option(departamentos[i].nombreDepartamento,departamentos[i].idDepartamento);
			
		}

		$('select').material_select();

	}
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