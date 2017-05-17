<script>
	window.onload=ocultarBarra();
    $('#email').val(' ');
</script>
<?php
include_once ("../../controladora/ctrListaUsuario.php");
$control = new ctrListaUsuario();
$listaUsuarios = $control->obtenerListaUsuarios();

foreach ($listaUsuarios as $usuario) {
	$arr[] = array(
	'cedula' => $usuario->getCedula(),
	);
}
$ArrayJson = json_encode($arr);

?>
<div class="row">
    <form class="responsive" id="IRegistrarUsuarios" method="Post" role="form">
        <div class="inputs blue darken-3 col s6 m6 l6 z-depth-5">
            <h3>Registrar Usuario</h3>
            <div class="">
				<label  for="cedulaUsuario">C&eacutedula:</label>
				<input type="text" name="cedula" id="cedula" onchange="compararCedula()">
			</div>
            <div class="">
				<label  for="nombreUsuario">Nombre:</label>
				<input type="text" name="nombre" id="nombre">
			</div>
            <div class="">
				<label  for="primerApellidoUsuario">Primer apellido:</label>
				<input type="text" name="primerApellido" id="primerApellido">
			</div>
            <div class="">
				<label  for="segundoApellidoUsuario">Segundo apellido:</label>
				<input type="text" name="segundoApellido" id="segundoApellido">
			</div>
            <div class="">
				<label  for="telefono">Tel&eacutefono: </label></label>
				<input type="number" name="telefono" id="telefono">
			</div>
            <div class="">
				<label  for="email">Correo electr&oacutenico:</label>
				<input type="text" name="email" id="email">
			</div>
            <div class="">
				<label  for="clave">Contrase&ntildea:</label>
				<input type="password" name="clave" id="clave">
			</div>
            <div class="">
				<label  for="cargo">Cargo:</label>
				<input type="text" name="cargo" id="cargo">
			</div>
            <div class="">
                <label  for="Tipo">Tipo de Usuario:</label>
                <select id="tipo" name="tipo">
					<option value="Usuario">Usuario</option> 
                    <option value="Administrador">Administrador</option> 
				</select>
            </div>
            <div>
				<input id="btn_Guardar" type="submit" value="Guardar" class="btn btn-default"></br></br>
			</div>
        </div>
    </form>
</div>
<script>
$( document ).ready(function(){
    $('select').material_select();
});
$(document).ready(function() {
    $("#IRegistrarUsuarios").validate({
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
            insertarUsuarios();
        }
    });
});

function compararCedula(){
    var cedula = $('#cedula').val();
    var lUsuarios = eval(<?php echo $ArrayJson ?>);
    var esta = 0;
     for(i=0;i<lUsuarios.length;i++){
         if(lUsuarios[i].cedula == cedula){
             esta = 1;
         }  
     }
     if(esta == 1){
         Materialize.toast('El n&uacutemero de c&eacutedula ya se encuentra registrado!', 5000, 'red');
         document.getElementById('btn_Guardar').disabled=true;
     } else{
         document.getElementById('btn_Guardar').disabled=false;
     }
}
</script>

