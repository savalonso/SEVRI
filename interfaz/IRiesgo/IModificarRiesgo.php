<?php 
	session_start();
	if(!$_SESSION){
		echo "<meta http-equiv=\"refresh\" content=\"0; url=paginaPrincipal.php\">";
    }else{
 ?>
<?php
	$idRiesgo = $_GET['idRiesgo'];
	include ("../../data/dtRiesgo.php");
	//include ("../../dominio/dRiesgo.php");
	$control = new dtRiesgo;
	$lista = $control->getRiesgo($idRiesgo);
	if($lista!=null){
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
	}

	include ("../../controladora/ctrDatosSevri.php");
	$control1 = new ctrDatosSevri;	
	$listaC =$control1->obtenerTodasLasCategorias();
	if($listaC!=null){
		foreach ($listaC as $categoria) {
			if($categoria->getIdCategoria()==$subcategoria){
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
	}
?>	
<script>
	window.onload=ocultarBarra();
</script>
<div id="divContenedorM" class="divContenedorM">
	<div id="divMsjCategoria" class="divMsjCategoria">
		<div id="msjCategoria" class="msjCategoria" style="display:none;"></div>
	</div>
	<div id="divMsjSubCategoria" class="divMsjSubCategoria">
		<div id="msjSubCategoria" class="msjSubCategoria" style="display:none;"></div>
	</div>
</div>	
<div class="row">
	<form class="responsive" id="IModificarRiesgo" method="Post" role="form">
		<div class="inputs blue darken-3 col s12 m6 l6 z-depth-5">
			<h3>Modificar Riesgo</h3>
			<div >
				<label for="nombre">Nombre:</label><br>
				<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre";?>">
			</div>

			<div class="">
				<label for="descripcion">Descripci&oacuten:</label>
				<textarea class="materialize-textarea" rows="10" celds="30" id="descripcion" name="descripcion"><?php echo "$descripcion";?></textarea>
			</div>

			<div >
				<label  for="estado">Estado:</label></br></br>
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

			<div >
				<label for="monto">Monto econ&oacutemico en col&oacutenes:</label>
				‎<input type="text" name="monto" id="monto" onkeyup="format(this)" value="<?php echo "$monto";?>">‎
			</div>
			
			<div >
				<label  for="categoria">Categor&iacutea:</label></br></br>
				<select id="categoria" name="categoria" onchange="llenarSelect2(this.value)"> 
					
				<?php
					if($listaC!=null){
						echo "<option value=\"0\">Seleccione una categor&iacutea...</option>";
						foreach ($listaC as $categoria){
							if($categoria->getHijoDe()=="0"){
								if($categoria->getIdCategoria()==$padre){
									echo "<option selected=\"true\" value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}else{
									echo "<option value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}	
							}
						}
					}else{
						echo "<option value=\"0\">No hay categor&iacuteas registradas</option>";
					}
					
				?>
				</select>
			</div>
			
			<div>
				<label  for="subcategoria">Sub Categor&iacuteas:</label></br></br>
				<select id="subcategoria" name="subcategoria" onchange="mostrarSubcategoria(this.value)">
				<option value="0">Seleccione una sub categor&iacutea...</option> 
				<?php 
					if($listaC!=null){
						echo "<option value=\"0\">Seleccione una sub categor&iacutea...</option>";
						foreach ($listaC as $categoria){
							if($categoria->getHijoDe()==$padre){
								if($categoria->getIdCategoria()==$subcategoria){
									echo "<option selected=\"true\" value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}else{
									echo "<option value=".$categoria->getIdCategoria()." >".$categoria->getNombreCategoria()."</option>";
								}	
							}
						}
					}else{
						echo "<option value=\"0\">No hay sub categor&iacuteas registrdas</option>";
					}
				}//cierre del if de variable de sesion
				?>
				</select>
			</div>

			<div >
				<label for="causa">Causa:</label>
				<textarea class="materialize-textarea" rows="10" cels="30" id="causa" name="causa"><?php echo "$causa";?></textarea>
			</div>

			<div >
				<input type="hidden" name="id" id="id" value="<?php echo "$idRiesgo";?>">
			</div>
			<div>
			<?php
				echo "<button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacion($id)\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Modificar</a> </button>";
			?>
			</div>
		</div>
	</form>
	<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idRiesgo" name="idRiesgo">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="modificarRiesgo()"/>
		</div>
	</div>
</div>

<script>
	$( document ).ready(function(){
	   	$('select').material_select();
	   	$('.modal-trigger').leanModal();
	   	format(document.getElementById("monto"));
	});
	$(document).ready(function() {
	    if(document.getElementById('subcategoria').disabled==true){
			$("#IIdentificarRiesgo").validate({
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
			$("#IIdentificarRiesgo").validate({
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
		           if(document.getElementById('categoria').value==0){
		        		Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
		        	}else{
		        		modificarRiesgo();
		        	}
		        }
		    });
		}
	});
	function llenarSelect2(valor){
		var categorias = eval(<?php echo $ArrayJson ?>);
		if(valor == 0){
			 document.getElementById("subcategoria").disabled=true;
		}else{
			document.getElementById("subcategoria").options.length=0;
			document.getElementById("subcategoria").options[0]=new Option("Selecciona una subcategoria", "0");
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
		if(!isNaN(num)){
			num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split('').reverse().join('').replace(/^[\.]/,'');
			num = num.replace(/\./g,'.');
			input.value = num;
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