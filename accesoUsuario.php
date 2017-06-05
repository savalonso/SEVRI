<?php
    session_start();
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['clave'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$tipo = $_POST['tipo'];
	
	
			$_SESSION['idUsuario'] = $usuario;
			$_SESSION['tipo'] = $tipo;
			$_SESSION['nombreUsuario'] =$nombre;
			$_SESSION['apellidoUsuario'] = $apellido;

			header("location:interfaz/paginaPrincipal.php");
	
?>