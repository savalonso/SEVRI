<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
	$idRiesgo = $_GET['idRiesgo'];
	include ("../../data/dtRiesgo.php");
	$control = new dtRiesgo;
	$lista = $control->getRiesgo($idRiesgo);
	foreach ($lista as $riesgo) {
		$id = $riesgo->getId();
		$idDepartamento = $riesgo->getIdDepartamento();
		$nombre = $riesgo->getNombre();
		$descripcion = $riesgo->getDescripcion();
		$monto = $riesgo->getMontoEconomico();
		$causa = $riesgo->getCausa();
		$subcategoria = $riesgo->getIdCategoria();
		$estado = $riesgo->getEstaActivo();
	}

	include ("../../controladora/ctrDatosSevri.php");
	$control1 = new ctrDatosSevri;	
	$listaC =$control1->obtenerTodasLasCategorias();
	$padre = 0;
	foreach ($listaC as $categoria) {
		if($categoria->getIdCategoria()== $subcategoria && $categoria->getHijoDe() != 0){
			$padre = $categoria->getHijoDe();
		}
		$arr[] = array(
		'_id' => $categoria->getIdCategoria(),
        'nombre' => $categoria->getNombreCategoria(),
        'padre' => $categoria->getHijoDe(),
        'descripcion' => utf8_encode($categoria->getDescripcion())
    	); 	
	}
	$ArrayJson =json_encode($arr);
?>	
<script>
	window.onload=ocultarBarra();
</script>

	<h4>Modificar Riesgo</h4>
	<form id="IModificarRiesgo" method="Post" role="form" class="responsive">
		<div class="row">
		<input type="hidden" name="idDepartamento" id="idDepartamento" value="<?php echo "$idDepartamento";?>">
			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label class="white-text" for="nombre">Nombre:</label>
					<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre";?>">
				</div>
			</div>

			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label for="descripcion">Descripci&oacuten:</label>
				<textarea class="materialize-textarea scrollTextArea" rows="10" celds="30" id="descripcion" name="descripcion"><?php echo "$descripcion";?></textarea>
				</div>
			</div>

			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label class="white-text" for="estado">Estado:</label>
					<select id="estado" name="estado"> 
						<?php
							if($estado=="Activo"){
								echo"<option selected=\"true\" value=\"1\">Activo</option>";
								echo"<option value=\"0\">Inactivo</option>";
							}else{
								echo"<option value=\"1\">Activo</option>";
								echo"<option selected=\"true\" value=\"0\">Inactivo</option>";
							}
						?>
					</select>
				</div>
			</div>

			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label for="monto">Monto econ&oacutemico:</label>
				‎	<input type="text" name="monto" id="monto" onkeyup="format(this)" value="<?php echo "$monto"; ?>">‎
				</div>
			</div>

			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label  for="categoria">Categor&iacutea:</label></br></br>
					<select id="categoria" name="categoria" onchange="llenarSelect2(this.value)"> 
						<option value="0" disabled="true">Seleccione una categor&iacutea...</option>
					<?php 
						foreach ($listaC as $categoria){
							if($categoria->getHijoDe()=="0"){
								if($categoria->getIdCategoria()==$subcategoria){
									echo "<option selected=\"true\" value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}else{
									echo "<option value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}	
							}
						}
					?>
					</select>
				</div>
				<div class="inputs col s6 m6 l6" style="padding: 10px;">
					<p id="opcion_Cat" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
				</div>
			</div>

			<div <?php if ($padre == 0) { ?> style="display:none" <?php } ?> id="contenedorSubcategoria" class="col s12 m12 l12" >
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label  for="subcategoria">Sub Categor&iacutea:</label>
					<?php 
					if($padre == 0){
						echo "<select id=\"subcategoria\" disabled=\"true\" name=\"subcategoria\" onchange=\"mostrarSubcategoria(this.value)\">";
					}else{
						echo "<select id=\"subcategoria\" name=\"subcategoria\" onchange=\"mostrarSubcategoria(this.value)\">";
					}
					?>
					<select id="subcategoria" name="subcategoria" onchange="mostrarSubcategoria(this.value)">
					<option value="0" disabled="true">Seleccione una sub categor&iacutea...</option> 
					<?php 
						foreach ($listaC as $categoria){
							if($categoria->getHijoDe()!= 0){
								if($categoria->getIdCategoria()==$subcategoria){
									echo "<option selected=\"true\" value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}else{
									echo "<option value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}	
							}
						}
					?>
					</select>
				</div>

				<div class="inputs col s6 m6 l6" style="padding: 10px;">
					<p id="opcion_Sub" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
				</div>
			</div>

			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<label class="white-text" for="causa">Causa:</label>
							<textarea class="materialize-textarea scrollTextArea" rows="10" cels="30" id="causa" name="causa" ><?php echo "$causa"; ?></textarea>
				</div>
			</div>

			<div>
				<input type="hidden" name="id" id="id" value="<?php echo "$idRiesgo";?>">
			</div>

			<div class="col s12 m12 l12">
				<div class="inputs blue darken-3 col s6 m6 l6">
					<?php echo "<button type=\"button\" class=\"btnEliminar btnModal\" id=\"btnModificarRiesgo\" onclick=\"confirmarModificacionEliminacion($id)\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Modificar</a> </button>";?> 
				</div><br><br>
			</div>

			<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
					<input type="hidden" id="idRiesgo" name="idRiesgo">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat btnAccionCrud"/>
				</div>
			</div>

		</div>
	</form>


<script>
	$( document ).ready(function(){
	   	$('select').material_select();
	   	$('.modal-trigger').leanModal();
	   	format(document.getElementById("monto"));
	});
	$(document).ready(function() {
	    if(document.getElementById('subcategoria').disabled==true){
			$("#IModificarRiesgo").validate({
		        rules: {
		            nombre: { required: true,minlength: 10, maxlength: 100},
		            descripcion: { required:true,minlength: 20, maxlength: 3000},
		            estado: {required : true},
		            monto: {required: true, maxlength: 15},
		            categoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000}
		        },
		        messages: {
		            nombre: "Debe introducir un nombre al riesgo mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten al riesgo mayor de 20 car&aacutecteres.",
		            estado: "Debe seleccionar un estado.",
		            monto: "Debe introducir un monto no mayor de 11 d&iacutegitos.",
		            categoria: "Debe seleccionar una categor&iacutea.",
		            causa: "Debe introducir una causa mayor a 20 car&aacutecteres y un maximo de 2000.",
		        },
		        submitHandler: function(form){
		           if(document.getElementById('categoria').value==0){
		        		Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		modificarRiesgo();
		        	}
		        }
		    });
		}else{
			$("#IModificarRiesgo").validate({
		        rules: {
		            nombre: { required: true,minlength: 10, maxlength: 100},
		            descripcion: { required:true,minlength: 20, maxlength: 3000},
		            estado: {required : true},
		            monto: {required: true, maxlength: 15},
		            subcategoria: {required: true},
		            causa: {required:true, minlength: 20,maxlength: 2000}
		        },
		        messages: {
		            nombre: "Debe introducir un nombre al riesgo mayor de 10 car&aacutecteres.",
		            descripcion: "Debe introducir una descripci&oacuten al riesgo mayor de 20 car&aacutecteres.",
		            estado: "Debe seleccionar un estado.",
		            monto: "Debe introducir un monto no mayor de 11 d&iacutegitos.",
		            subcategoria: "Debe seleccionar una sub categor&iacutea.",
		            causa: "Debe introducir una causa mayor a 20 car&aacutecteres y un maximo de 2000.",
		        },
		        submitHandler: function(form){
		           if(document.getElementById('subcategoria').disabled==false && document.getElementById('subcategoria').value==0){
		        		Materialize.toast("Debe de seleccionar una subcategor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		modificarRiesgo();
		        	}
		        }
		    });
		}
	});
	function llenarSelect2(valor){
		var categorias = eval(<?php echo $ArrayJson ?>);
		var tieneHijos = false;
		if(valor == 0){
			 document.getElementById("subcategoria").disabled=true;
		}else{
			document.getElementById("subcategoria").options.length=0;
			document.getElementById("subcategoria").options[0]=new Option("Selecciona una subcategoria", "0");
			document.getElementById("subcategoria").options[0].disabled = true;
			 for(i=0;i<categorias.length;i++){
				if(categorias[i].padre == valor){
          		 	document.getElementById('contenedorSubcategoria').style.display = "";
                	document.getElementById("subcategoria").options[document.getElementById("subcategoria").options.length]=
                	new Option(categorias[i].nombre,categorias[i]._id);
                	tieneHijos = true;
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