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
	<script type="text/javascript" src="../js/jsSevri.js"></script>
	<script>
		window.onload=ocultarBarra();
	</script>
	<?php 
	   include('../../controladora/ctrListaSevri.php');
	   $idSevri = $_GET['IdSevri'];
	   $control = new ctrListaSevri();
	   $sevri = $control->obtenerSevri($idSevri);

	   $nombre = $sevri->getNombreVersion();
	   $fecha = $sevri->getFechaVersion();
	   $id = $sevri->getIdSevri();
       $añoActual = date("Y");
	 ?>
	
	 <h1>Modificar SEVRI</h1>

	 <div class="row">
	 	<form id="actualizarSevri" method="POST">
	 		
	 		<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
	 			<div>
	 				<label for="nombre">Nombre SEVRI</label>
	 				<input type="text" id="nombre" name="nombre" placeholder="<?php echo "Dato:"."$nombre"; ?>" value="<?php echo "$nombre"; ?>" checked></label>
	 			</div>
	 				
	 			<div>
	 				<label for="fecha"> Fecha Creaci&oacuten</label>
	 				<input type="date" id="fecha" name="fecha" placeholder="<?php echo "Dato:"."$fecha"; ?>" value="<?php echo "$fecha"; ?>" min="<?php echo $fecha; ?>" max="<?php echo date("Y")."-12-"."31"; ?>"></label>
	 			</div>
	 			<div>
	 				<a class="waves-effect waves-light btn modal-trigger" href="#Mconfirmar">Actualizar</a>
	 			</div>
	 			<input type="number" id="id" name="opcion" value="<?php echo "$id"; ?>" style="display:none">
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

	 
		<div id="mRespuesta">
			
		</div>
		<script>
		$(document).ready(function() {
	    $("#actualizarSevri").validate({
	        rules: {
	            nombre: { required: true, minlength: 5, maxlength: 100},
	            fecha: { required: true}
	        },
	        messages: {
	            nombre: "Debe introducir el nombre del SEVRI.",
	            fecha: "Debe introducir una fecha."
	        },
	        submitHandler: function(form){
	           actualizarSevri();
	        }
	    });
		});
		$(function(){
		  $('#nombre').mask('SEVRI-<?= $añoActual ?>-99');
		});
		$(document).ready(function(){
   		  $('.modal-trigger').leanModal();
  		});
		</script>
