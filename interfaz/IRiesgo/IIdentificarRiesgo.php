<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
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
		$cedula=$_SESSION['idUsuario'];
		include("../../controladora/ctrListaDepartamento.php");
		include ("../../controladora/ctrDatosSevri.php");
		$controlDepartamentos=new ctrListaDepartamento;
		$controlSevriCategorias = new ctrDatosSevri;
		$listaDepartamentos=$controlDepartamentos->obtenerListaDepartamentosUsuario($cedula);
		$listaCategorias =$controlSevriCategorias->obtenerTodasLasCategorias();	
		
		if(empty($listaDepartamentos)){
			
			echo "<br><h4>No se puede realizar este proceso porque usted no ha sido agregado a un departamento.</h4>";


		}else{

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
			$ArrayJson =json_encode($arr);
		?>
			<h4>Identificar Riesgo</h4>
			<form id="IIdentificarRiesgo" method="Post" role="form" class="responsive">
				<div class="row">
					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label class="white-text" for="departamentoUsuario">Departamento:</label>
	           				 <select id="departamentoUsuario" name="departamentoUsuario">
								<option value="0" disabled="true" selected>Seleccione un departamento</option>
								<?php
									foreach ($listaDepartamentos as $departamento){
								?>
										<option value="<?php echo $departamento->getIdDepartamento();?>"><?php echo $departamento->getNombreDepartamento();?></option>;
								<?php 
									} 
								?>
	                		
							</select>

	        			</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label class="white-text" for="nombre">Nombre:</label>
							<input type="text" name="nombre" id="nombre">
						</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label class="white-text" for="descripcion">Descripci&oacuten:</label>
							<textarea class="materialize-textarea scrollTextArea" rows="10" celds="30" id="descripcion" name="descripcion" ></textarea>
						</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label class="white-text" for="estado">Estado:</label>
							<select id="estado" name="estado"> 
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label class="white-text" for="monto">Monto Econ&oacutemico:</label>
							<input type="text" name="monto" id="monto" onkeyup="format(this)">
						</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
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
						<div class="inputs col s6 m6 l6" style="padding: 10px;">
							<p id="opcion_Cat" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
						</div>
					</div>

					<div id="contenedorSubcategoria" class="col s12 m12 l12" style="display:none">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label  class="white-text" for="subcategoria">Sub Categor&iacutea:</label>
							<select id="subcategoria" name="subcategoria" onchange="mostrarSubcategoria(this.value)" disabled="true"> 
								<option disabled="true" selected="true" value="0">Seleccione una sub categor&iacutea...</option>
							</select>
						</div>

						<div class="inputs col s6 m6 l6" style="padding: 10px;">
							<p id="opcion_Sub" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
						</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<label class="white-text" for="causa">Causa:</label>
							<textarea class="materialize-textarea scrollTextArea" rows="10" cels="30" id="causa" name="causa" ></textarea>
						</div>
					</div>

					<div class="col s12 m12 l12">
						<div class="inputs blue darken-3 col s6 m6 l6">
							<input type="submit" id="btnInsertarRiesgo" value="Insertar" class="btn btn-default"></br><br>
						</div>
					</div>

				</div>
			</form>

		

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
		        	departamentoUsuario:{required : true},
		            nombre: { required: true,minlength: 10, maxlength: 100},
		            descripcion: { required:true,minlength: 20, maxlength: 3000},
		            estado: {required : true},
		            monto: {minlength: 1,maxlength: 15},
		            categoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000},
		        },
		        messages: {
		        	departamentoUsuario: "Debe seleccionar un departamento.",
		            nombre: "Se debe ingresar un nombre con un mínimo de 10 caracteres y máximo de 100",
		            descripcion: "Se debe ingresar una descripción con un mínimo de 20 caracteres y máximo de 3000",
		            estado: "Debe seleccionar un estado",
		            monto: "Se debe ingresar un monto con un mínimo de 1 dígito y máximo de 15",
		            categoria: "Debe seleccionar una categor&iacutea.",
		            causa: "Se debe ingresar una causa con un mínimo de 20 caracteres y máximo de 2000",
		        },
		        submitHandler: function(form){
		        	if(document.getElementById('departamentoUsuario').value==0){
		        		Materialize.toast("Debe de seleccionar un departamento", 7000,'blue darken-3');
		        	}else if(document.getElementById('categoria').value==0){
		        		Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else if(document.getElementById('subcategoria').disabled==false && document.getElementById('subcategoria').value==0){
		        		Materialize.toast("Debe de seleccionar una subcategor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		insertarRiesgo();
		        	}
		        }
		    });
		}else{
			$("#IIdentificarRiesgo").validate({
		        rules: {
		        	departamentoUsuario:{required : true},
		            nombre: { required: true,minlength: 10, maxlength: 100},
		            descripcion: { required:true,minlength: 20, maxlength: 3000},
		            estado: {required : true},
		            monto: {minlength: 1,maxlength: 15},
		            subcategoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000},
		        },
		        messages: {
		        	departamentoUsuario: "Debe seleccionar un departamento.",
		            nombre: "Se debe ingresar un nombre con un mínimo de 10 caracteres y máximo de 100",
		            descripcion: "Se debe ingresar una descripción con un mínimo de 20 caracteres y máximo de 3000",
		            estado: "Debe seleccionar un estado",
		            monto: "Se debe ingresar un monto con un mínimo de 1 dígito y máximo de 15",
		            subcategoria: "Debe seleccionar una subcategor&iacutea.",
		            causa: "Se debe ingresar una causa con un mínimo de 20 caracteres y máximo de 2000",
		        },
		        submitHandler: function(form){
		           if(document.getElementById('subcategoria').disabled==false && document.getElementById('subcategoria').value==0){
		        		Materialize.toast("Debe de seleccionar una subcategor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else if(document.getElementById('departamentoUsuario').value==0){
		        		Materialize.toast("Debe de seleccionar un departamento", 7000,'blue darken-3');
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
		var tieneHijos = false;
		if(valor == 0){
			document.getElementById("subcategoria").options.length=0;
			document.getElementById("subcategoria").disabled=true;
		}else{
			document.getElementById("subcategoria").options.length=0;
			document.getElementById("subcategoria").options[0]=new Option("Selecciona una subcategoria", "0");
			document.getElementById("subcategoria").options[0].disabled = true;
			 for(i=0;i<categorias.length;i++){
          		 if(categorias[i].padre == valor){
                	document.getElementById("subcategoria").options[document.getElementById("subcategoria").options.length]=
                	new Option(categorias[i].nombre,categorias[i]._id);
					tieneHijos = true;
					document.getElementById('contenedorSubcategoria').style.display = '';
           		}
           		document.getElementById("subcategoria").disabled=false;
       		}
       		if (!tieneHijos) {
       			document.getElementById("subcategoria").disabled=true;
       			document.getElementById('contenedorSubcategoria').style.display = 'none';
       		}
		}
		$('select').material_select();

		if(valor==0){
			$("#opcion_Cat").hide();
		}else{
			for (i=0;i<categorias.length;i++) {
				if(categorias[i]._id==valor){
					$("#opcion_Cat").show();
					$("#opcion_Cat").text(categorias[i].descripcion);
					setTimeout(function() {
						$("#opcion_Cat").fadeOut(5);
					},10000);
				}
			}
		}
		
	}

	function mostrarSubcategoria(id){
		var categorias = eval(<?php echo $ArrayJson ?>);
		if(id==0){
			$("#opcion_Sub").hide();
		}else{
			for(i=0;i<categorias.length;i++){
				if(categorias[i]._id==id){
					$("#opcion_Sub").show();
					$("#opcion_Sub").text(categorias[i].descripcion);
					setTimeout(function() {
						$("#opcion_Sub").fadeOut(5);
					},10000);
				}
			}
		}
	}
</script>
<?php
				}
		  ?>
</html>