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
include_once ("../../controladora/ctrListaUsuario.php");

$cedulaUsuario = $_GET['cedula'];

$control = new ctrListaUsuario;

$listaUsuarios = $control->obtenerUsuario($cedulaUsuario);


foreach ($listaUsuarios as $usuario) {
	
	$cedula = $usuario->getCedula();
	
	$nombre = $usuario->getNombre();
	
	$primerApellido = $usuario->getPrimerApellido();
	
	$segundoApellido = $usuario->getSegundoApellido();
	
	$telefono = $usuario->getTelefono();
	
	$correo = $usuario->getCorreo();
	
	$clave = $usuario->getClave();
	
	$cargo =  $usuario->getCargo();
	
	$tipo = $usuario->getTipo();
	
}

?>
<div class="row">
    <form class="responsive" id="IModificarUsuarios" method="Post" role="form">
        <div class="inputs blue darken-3 col s6 m6 l6 z-depth-5">
            <h3>Registrar Usuario</h3>
            <div class="">
				<label  for="cedulaUsuario">C&eacutedula:</label><br>
				<?php echo $cedula."</br></br>";
?>
			</div>
            <div class="">
				<label  for="nombreUsuario">Nombre:</label>
				<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre";
?>">
			</div>
            <div class="">
				<label  for="primerApellidoUsuario">Primer apellido:</label>
				<input type="text" name="primerApellido" id="primerApellido" value="<?php echo "$primerApellido";
?>">
			</div>
            <div class="">
				<label  for="segundoApellidoUsuario">Segundo apellido:</label>
				<input type="text" name="segundoApellido" id="segundoApellido" value="<?php echo "$segundoApellido";
?>">
			</div>
            <div class="">
				<label  for="telefono">Tel&eacutefono: </label></label>
				<input type="text" name="telefono" id="telefono" value="">
			</div>
            <div class="">
				<label  for="email">Correo electr&oacutenico:</label>
				<input type="text" name="email" id="email" value="<?php echo "$correo";
?>">
			</div>
            <div class="">
				<label  for="clave">Contrase&ntildea:</label>
				<input type="password" name="clave" id="clave" value="<?php echo "$clave";
?>">
			</div>
			<div class="">
				<label  for="clave">Confirmar contrase&ntildea:</label>
				<input type="password" name="clave2" id="clave2" value="<?php echo "$clave";
?>">
			</div>
            <div class="">
				<label  for="cargo">Cargo:</label>
				<input type="text" name="cargo" id="cargo" value="<?php echo "$cargo";
?>">
			</div>
            <div class="">
                <label  for="Tipo">Tipo de Usuario:</label>
                <select id="tipo" name="tipo">
					<?php if($tipo == "Usuario") { ?>
							<option value="Usuario">Usuario</option>
							<option value="Administrador">Administrador</option>
					<?php } else { ?>
							<option value="Administrador">Administrador</option>
							<option value="Usuario">Usuario</option>
					<?php } ?>
				</select>
            </div>
            <div>
				<input type="hidden" name="cedula" id="cedula" value="<?php echo "$cedula";
?>">
			</div>
            <div>
				<a class="waves-effect waves-light btn modal-trigger" id="btnModificarUsuario" href="#Mconfirmar">Modificar</a></br></br>
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
$(function(){
    $('#telefono').mask('9999-9999');
	$('#telefono').val('<?=$telefono?>');
});
$(document).ready(function(){
		$('.modal-trigger').leanModal();
	});
$( document ).ready(function(){
    $('select').material_select();
});
$(document).ready(function() {
    $("#IModificarUsuarios").validate({
        rules: {
            cedula:{ required: true, minlength: 7, maxlength: 20},
            nombre:{ required: true, minlength: 2, maxlength: 45},
            primerApellido:{ required: true, minlength: 2, maxlength: 45},
            segundoApellido:{ required: true, minlength: 2, maxlength: 45},
            telefono:{ required: true, minlength: 9, maxlength: 9},
            email:{ required: true},
            clave:{ required: true, minlength: 8, maxlength: 15},
			clave2:{ required: true, equalTo: "#clave"},
            cargo:{ required: true, minlength: 5},
        },
        messages: {
            cedula:"Se debe ingresar la c&eacutedula con un minimo de 7 d&iacutegitos y un m&aacuteximo de 15 d&iacutegitos",
            nombre:"Se debe ingresar el nombre con m&iacutenimo 2 caracteres y m&aacuteximo 45 carateres",
            primerApellido:"Se debe ingresar el primer apellido con m&iacutenimo 2 caracteres y m&aacuteximo 45 carateres",
            segundoApellido:"Se debe ingresar el segundo apellido con m&iacutenimo 2 caracteres y m&aacuteximo 45 carateres",
            telefono:"Se debe ingresar el tel&eacutefono con un m&aacuteximo y m&iacutenimo de 8 digitos",
            email:"Se debe ingresar un correo electr&oacutenico v&aacutelido",
            clave:"Se debe ingresar una contrase&ntildea con un m&iacute de 8 carateres y un m&aacuteximo de 15 caracteres",
			clave2:"Se debe ingresar una contrase&ntildea igual a la anterior",
            cargo:"Se debe de ingresar un cargo",
        },
        submitHandler: function(form){
            modificarUsuarios();
        }
    });
});
</script>