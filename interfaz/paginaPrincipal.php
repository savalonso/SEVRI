<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SEVRI</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../Materialize/css/materialize.css?v=10">
	<link href="../Materialize/css/icon.css?v=1" rel="stylesheet">
	<link rel="stylesheet" href="../Materialize/css/Style.css?v=2">
	<script src="../js/jQuery.js?v=1"></script>
	<script src="../js/jquery.maskedinput.js?v=1"></script>
	<script type="text/javascript" src="../js/jsPaginadorTablas.js?v=3"></script>
	<script src="../Materialize/js/materialize.js?v=1"></script>
	<script type="text/javascript" src="../js/jsSevri.js?v=6"></script>
	<script src="../js/jsRiesgo.js?v=1"></script>
	<script src="../js/jsAnalisis.js?v=2"></script>
	<script src="../js/jsNivelRiesgo.js?v=1"></script>
	<script src="../js/jsAdministracion.js?v=2"></script>
	<script src="../js/jsUsuarios.js?v=3"></script>
	<script src="../js/jsDepartamento.js?v=2"></script>
	<script type="text/javascript" src="../js/jsSeguimiento.js?v=1"></script>
	<script type="text/javascript" src="../js/jsCategoria.js?v=2"></script>
	<script type="text/javascript" src="../js/jsParametros.js?v=9"></script>
	<script type="text/javascript" src="../js/jsHistorial.js?v=1"></script>
	<script type="text/javascript" src="../js/jquery.validate.min.js?v=1"></script>
</head>	
<body>
		<?php 
			$cedula= $_SESSION['idUsuario'];
			$tipo = $_SESSION['tipo'];
			if($cedula != null){
				if($tipo == "Administrador"){
					include('../HeaderFooter/header.php');
				}else{
					include('../HeaderFooter/headerUsuario.php');
				}
		?>

		<main>
			<div class="preloader-wrapper big active posicionBarra" id="barraCargando" style="display:none">
			  <div class="spinner-layer spinner-blue">
				    <div class="circle-clipper left">
					    <div class="circle"></div>
				   </div>
				   <div class="gap-patch">
						<div class="circle"></div>
				   </div>
				   <div class="circle-clipper right">
					    <div class="circle"></div>
				   </div>
			  </div>

			  <div class="spinner-layer spinner-red">
				    <div class="circle-clipper left">
				       <div class="circle"></div>
				    </div>
				    <div class="gap-patch">
				       <div class="circle"></div>
				    </div>
				    <div class="circle-clipper right">
				       <div class="circle"></div>
				    </div>
			  </div>

			  <div class="spinner-layer spinner-yellow">
				    <div class="circle-clipper left">
				       <div class="circle"></div>
				    </div>
				    <div class="gap-patch">
				       <div class="circle"></div>
				    </div>
				    <div class="circle-clipper right">
				       <div class="circle"></div>
				    </div>
			  </div>

		      <div class="spinner-layer spinner-green">
			        <div class="circle-clipper left">
			           <div class="circle"></div>
			        </div>
			        <div class="gap-patch">
			           <div class="circle"></div>
			        </div>
			        <div class="circle-clipper right">
			           <div class="circle"></div>
			        </div>
		      </div>
           </div>
			<div id="contenedor" class="container contForm"></div>
			<div id="mRespuesta"></div>
	    </main>
	
 		<?php 
			include('../HeaderFooter/footer.php');
		 ?>

	<?php }else{
		//header("location:../index.php");
	} ?>

    </body>
</html>