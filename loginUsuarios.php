<!DOCTYPE html>
<html>

<head>
	<title>Login Usuarios</title>
	<link rel="stylesheet" href="Materialize/css/Style.css">
	<link href="Materialize/css/icon.css" rel="stylesheet">
	<link rel="stylesheet" href="Materialize/css/materialize.css">

	<script src="js/jQuery.js"></script>
	<script src="Materialize/js/materialize.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styleLogin.css">
</head>

	<script>
		window.onload=ocultarBarra();
	</script>
	<div>
	 	<a class="waves-effect waves-light btn modal-trigger" href="#login" onclick="limpiar()">Login</a>
	</div>

 	<div id="login" class="modal blue darken-3 z-depth-5 white-text">
		<div class="modal-content" id="contenido">
			<div id="contenidoFormulario">
				<form id="ingresoSistema" method="Post" action="accesoUsuario.php">
					<div  id="inputsIngreso" >
						<h5>Ingreso al sistema</h5><br></br>
						<img src="img/user2.png" alt=""  >	
						<div>
							<label class="white-text" for="usuario">Usuario</label>
							<input class="white-text" type="text" name="usuario" id="usuario" style="text-align: center;width: 100%;">
						</div>
 						<div>
 							<label class="white-text" for="clave">Clave</label>
							<input class="white-text" type="password" name="clave" id="clave" style="text-align: center; width: 100%;">
						</div>
					</div>
					<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
	 				<input type="submit" value="Ingresar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				</form>	
			</div>			    
		</div>	
	</div>	
	<script>
		$(document).ready(function(){
		   	$('.modal-trigger').leanModal();
		});
		function limpiar(){
			document.getElementById('usuario').value="";
			document.getElementById('clave').value="";
		}		
	</script>
</html>
