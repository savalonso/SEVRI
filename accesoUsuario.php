<?php
	include_once ("data/dtConnection.php");
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['clave'];
	
	if(isset($usuario)){
		$conex =mysql_connect("localhost","root","") or die("No se pudo conectar con el servidor");
		mysql_select_db("bdsevri",$conex) or die("Error con la base de datos");
		session_start();
		$consulta = ("CALL obtenerUsuarioLogin('".$usuario."','".$contrasena."')"); 
		$resultado = mysql_query($consulta,$conex) or die (mysql_error());
		$fila = mysql_fetch_array($resultado);
		
		if(!$fila['Tipo']){
			header("location:loginUsuarios.php");
		}
		else{
			$_SESSION['idUsuario'] = $fila['Cedula'];
			$_SESSION['tipo'] = $fila['Tipo'];
			$_SESSION['nombreUsuario'] = $fila['Nombre'];
			$_SESSION['apellidoUsuario'] = $fila['PrimerApellido'];

			header("location:interfaz/paginaPrincipal.php");
		}
	}
	else{
		header("location:index.php");
	}
?>