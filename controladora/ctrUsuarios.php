<?php 
	class ctrUsuarios {

        function ctrUsuarios(){}

        function insertarUsuarios(){
        	include_once ("../dominio/dUsuarios.php");
			include_once ("../data/dtUsuarios.php");
	      	$usuario = new dUsuarios;

    		$usuario->setCedula($_POST['cedula']);
            $usuario->setNombre($_POST['nombre']);
            $usuario->setPrimerApellido($_POST['primerApellido']);
            $usuario->setSegundoApellido($_POST['segundoApellido']);
            $usuario->setTelefono($_POST['telefono']);
            $usuario->setCorreo($_POST['email']);
            $usuario->setClave($_POST['clave']);
            $usuario->setCargo($_POST['cargo']);
            $usuario->setTipo($_POST['tipo']);
	      	$dataUsuarios = new dtUsuarios;
	      	if($dataUsuarios->insertarUsuario($usuario) == true){
	      		echo 
	      		'
	      			Se ha insertado correctamente el usuario.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido insertar el usuario.
	      		';
	      	}
		}

		function actualizarUsuarios(){
			include_once ("../dominio/dUsuarios.php");
			include_once ("../data/dtUsuarios.php");
			$usuario = new dUsuarios();
			
			$usuario->setNombre($_POST['nombre']);
			$usuario->setPrimerApellido($_POST['primerApellido']);
			$usuario->setSegundoApellido($_POST['segundoApellido']);
			$usuario->setTelefono($_POST['telefono']);
			$usuario->setCorreo($_POST['email']);
			$usuario->setClave($_POST['clave']);
			$usuario->setCargo($_POST['cargo']);
			$usuario->setTipo($_POST['tipo']);
	      	$cedula = $_POST['cedula'];
	      
	      	$dataUsuario = new dtUsuarios();
               
	      	if($dataUsuario->actualizarUsuario($usuario,$cedula) == true){
	      		echo 
	      		'	
	      			Se ha modificado correctamente el usuario.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido modificar el usuario.
	      		';
	      	}
		}

		function eliminarUsuarios(){
			include_once ("../dominio/dUsuarios.php");
			include_once ("../data/dtUsuarios.php");
    		$cedula = $_POST['cedula'];
	      	$dataUsuarios = new dtUsuarios;
               
	      	if($dataUsuarios->eliminarUsuarios($cedula) == true){
	      		echo 
	      		'	
	      			Se ha eliminado correctamente el usuario.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido eliminar el usuario.
	      		';
	      	}
		}

		function marcarMensajeLeido(){
			include_once ("../logica/logicaUsuario.php");
    		$idMensaje = $_POST['idMensaje'];
	      	$logica = new logicaUsuario;
	      	$logica->marcarMensajeLeido($idMensaje);
	      	echo "true";
		}

		function contarMensajesNoLeidos(){
			include_once ("../logica/logicaUsuario.php");
    		$idUsuario = $_POST['cedula'];
	      	$logica = new logicaUsuario;
	      	$cantidadMensajes = $logica->contarMensajesNuevos($idUsuario);
	      	echo $cantidadMensajes;
		}

    }

    $op = $_POST['opcion'];
	$control = new ctrUsuarios;
	if($op == 1){
	 	$control->insertarUsuarios();
	}
	else if($op == 2){
	 	$control->actualizarUsuarios();
	}
	else if($op == 3){
	 	$control->eliminarUsuarios();
	}
	else if($op == 4){
	 	$control->contarMensajesNoLeidos();
	}
	else if($op == 5){
	 	$control->marcarMensajeLeido();
	}
?>