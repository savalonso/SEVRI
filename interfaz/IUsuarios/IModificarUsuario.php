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
				<input type="number" name="telefono" id="telefono" value="<?php echo "$telefono";
?>">
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
				<label  for="cargo">Cargo:</label>
				<input type="text" name="cargo" id="cargo" value="<?php echo "$cargo";
?>">
			</div>
            <div class="">
                <label  for="Tipo">Tipo de Usuario:</label>
                <select id="tipo" name="tipo">
                        <option value="Usuario">Usuario</option>
                        <option value="Administrador">Administrador</option>
				</select>
            </div>
            <div>
				<input type="hidden" name="cedula" id="cedula" value="<?php echo "$cedula";
?>">
			</div>
            <div>
				<a class="waves-effect waves-light btn modal-trigger" href="#Mconfirmar">Modificar</a></br></br>
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
    $("#IModificarUsuarios").validate({
        rules: {
            cedula:{ required: true, minlength: 7, maxlength: 20},
            nombre:{ required: true},
            primerApellido:{ required: true},
            segundoApellido:{ required: true},
            telefono:{ required: true, minlength: 8, maxlength: 8},
            email:{ required: true},
            clave:{ required: true},
            cargo:{ required: true},
        },
        messages: {
            cedula:"Se debe ingresar la c&eacutedula con un minimo de 7 d&iacutegitos y un m&aacuteximo de 15 d&iacutegitos",
            nombre:"Se debe ingresar el nombre",
            primerApellido:"Se debe ingresar el primer apellido",
            segundoApellido:"Se debe ingresar el segundo apellido",
            telefono:"Se debe ingresar el telefono con un m&aacuteximo y m&iacutenimo de 8 digitos",
            email:"Se debe ingresar un correo electr&oacutenico",
            clave:"Se debe ingresar una contrase&ntildea con un maximo de 15 caracteres",
            cargo:"Se debe de ingresar un cargo",
        },
        submitHandler: function(form){
            modificarUsuarios();
        }
    });
});
</script>