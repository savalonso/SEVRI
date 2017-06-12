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
</script>

<?php
	include_once('../../controladora/ctrListaDepartamento.php');
	$id=$_GET['idDepartamento'];
	$control=new ctrListaDepartamento;
	$listaDepartamento=$control->obtenerDepartamento($id);

	foreach ($listaDepartamento as $departamento) {
		$idDepartamento=$departamento->getIdDepartamento();
		$codigo=$departamento->getCodigoDepartamento();
		$nombre=$departamento->getNombreDepartamento();
		$fecha=$departamento->getFechaCreacion();
	}
?>

<div class="row">
		<form class="responsive" id="modificarDepartamento" method="Post" role="form">
			<div class="inputs blue darken-3 col col s8 m6 16 z-depth-5">
				<h3>Modificar Departamento</h3>
				
				<div class="">

					<div>
						<label  for="codigo">Codigo:</label>
						<input type="text" name="codigo" id="codigo" value="<?php echo "$codigo";?>">	
					</div>
					
					
				<div>
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre"; ?> ">
				</div>
				<div>
	 				<label for="fecha"> Fecha Creaci&oacuten</label>
	 				<input type="date" id="fecha" name="fecha" placeholder="<?php echo "Dato:"."$fecha"; ?>" value="<?php echo "$fecha"; ?>" min="<?php echo $fecha; ?>" max="<?php echo date("Y")."-12-"."31"; ?>"></label>
	 			</div>
	 			<div>
					<input type="hidden" name="idDepartamento" id="idDepartamento" value="<?php echo "$idDepartamento";?>">
				</div>
            	<div>
					<a class="waves-effect waves-light btn modal-trigger" id="btnModificarDepartamento" href="#Mconfirmar">Modificar</a></br></br>
				</div>
           		 <div id="Mconfirmar" class="modal blue darken-3 z-depth-5 white-text">
					<div class="modal-content">
						<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
					</div>
				<div class="modal-footer blue darken-3 z-depth-5">
					<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
					<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				</div>
			</div>

			</div>
		</form>
</div>

<script>
	
	$(document).ready(function(){
		$('.modal-trigger').leanModal();
	});
	$( document ).ready(function(){
   	 $('select').material_select();
	});
	$(document).ready(function() {
    	$("#modificarDepartamento").validate({
        	rules: {
        		codigo:{required:true, minlength:7,maxlength:45},
           		 nombre:{ required: true,minlength: 7, maxlength: 100},
           		 fecha:{ required: true},
            	
        },
        messages: {
        	codigo:"Se debe de ingresar un codigo con un minimo de 7 caracteres y maximo de 45 caracteres",
            nombre:"Se debe ingresar el nombre con un minimo de 7 caracteres y un maximo de 100 caracteres",
            fecha:"Se debe ingresar la fecha",
         
        },
        submitHandler: function(form){
            modificarDepartamento();
        }
    });
});

</script>

