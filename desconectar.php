<?php
	session_start();
	
	if($_SESSION['nombreUsuario']){
		session_destroy();

		header("location:loginUsuarios.php");
	}else{
		header("location:loginUsuarios.php");
	}
?>