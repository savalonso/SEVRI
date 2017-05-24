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
	<title>SEVRI</title>
	<script src="../../js/jQuery.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/jsTablas.js"></script>
    <script type="text/javascript" src="../../js/jsSevri.js"></script>
</head>
<body>
	
			<a href="javascript:cargarPagina('../../interfaz/ISevri/IcrearSevri.php')">Crear Sevri</a> <br>
		    <a href="javascript:cargarPagina('../../interfaz/ISevri/IMostrarSevri.php')">Mostrar Sevri</a> <br>
		    <a href="javascript:cargarPagina('../../interfaz/ISevri/IAgregarComponentesSEVRI.php')">Agregar parametros y 
		    categorias al sevri</a> <br>
		<hr>
		<div id="contenedor">
			<script>
				window.onload = cargarPagina('../../interfaz/ISevri/IMostrarSevri.php');
			</script>
		</div>
		
		<div id="mRespuesta">
		</div>
	
	
</body>
</html>