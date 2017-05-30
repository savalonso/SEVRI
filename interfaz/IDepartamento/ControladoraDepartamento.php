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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Departamento</title>
	<script src="../../js/jQuery.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/jsDepartamento.js"></script>
</head>
<body>
	
			<a href="javascript:cargarPagina('../../interfaz/IDepartamento/IInsertarDepartamento.php')">Crear Departamento</a> <br>
		    <a href="javascript:cargarPagina('../../interfaz/IDepartamento/IMostrarDepartamento.php')">Mostrar Departamentos</a> <br>
		 
		<hr>
		<div id="contenedor">
			<script>
				window.onload = cargarPagina('../../interfaz/IDepartamento/IMostrarDepartamento.php');
			</script>
		</div>
		
	
	
	
</body>
</html>