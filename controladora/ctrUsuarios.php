<?php 
 header("Content-Type: text/html; charset=iso-8859-1");  
	class ctrUsuarios {

        function ctrUsuarios(){}

        function insertarUsuarios(){
        	include_once ("../dominio/dUsuario.php");
			include_once ("../data/dtUsuario.php");
	      	$usuario = new dUsuario;

    		$usuario->setCedula($_POST['cedula']);
            $usuario->setNombre($_POST['nombre']);
            $usuario->setPrimerApellido($_POST['primerApellido']);
            $usuario->setSegundoApellido($_POST['segundoApellido']);
            $usuario->setTelefono($_POST['telefono']);
            $usuario->setCorreo($_POST['email']);
            $usuario->setClave($_POST['clave']);
            $usuario->setCargo($_POST['cargo']);
            $usuario->setTipo($_POST['tipo']);
	      	$dataUsuarios = new dtUsuario;
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
			include_once ("../dominio/dUsuario.php");
			include_once ("../data/dtUsuario.php");
			$usuario = new dUsuario();
			
			$usuario->setNombre($_POST['nombre']);
			$usuario->setPrimerApellido($_POST['primerApellido']);
			$usuario->setSegundoApellido($_POST['segundoApellido']);
			$usuario->setTelefono($_POST['telefono']);
			$usuario->setCorreo($_POST['email']);
			$usuario->setClave($_POST['clave']);
			$usuario->setCargo($_POST['cargo']);
			$usuario->setTipo($_POST['tipo']);
	      	$cedula = $_POST['cedula'];
	      	
			$dataUsuario = new dtUsuario();
               
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
			include_once ("../dominio/dUsuario.php");
			include_once ("../data/dtUsuario.php");
    		$cedula = $_POST['cedula'];
	      	$dataUsuarios = new dtUsuario;
               
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
		function ExisteUsuario(){
			include_once ("../logica/logicaUsuario.php");
			$usuario = $_POST['usuario'];
			$clave = $_POST['clave'];
			$logica = new logicaUsuario;
			$datos = $logica->ObtenerDatosUsuario($usuario,$clave);
			$datos = ctrUsuarios::Convertir_UTF8($datos);
			
			echo "".json_encode($datos)."";
		}
		function Convertir_UTF8($array)
		{
		   foreach ($array as $key => $value) {
		   	 $array[$key] = utf8_encode($value);
		   }
		    return $array;
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
	else if($op == 6){
	 	$control->ExisteUsuario();
	}
?>