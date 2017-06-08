<?php
    session_start();
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['clave'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$tipo = $_POST['tipo'];
	
	if(strlen($usuario)!= 0  && strlen($contrasena)!= 0  && strlen($nombre)!= 0  && strlen($apellido)!= 0  && strlen($tipo)!= 0)
	{
		$_SESSION['idUsuario'] = $usuario;
		$_SESSION['tipo'] = $tipo;
		$_SESSION['nombreUsuario'] =$nombre;
		$_SESSION['apellidoUsuario'] = $apellido;

		header("location:interfaz/paginaPrincipal.php");
	}else{
		header("location:index.php");
	}
			
?>