<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SEVRI</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../Materialize/css/materialize.css">
	<link href="../Materialize/css/icon.css" rel="stylesheet">
	<link rel="stylesheet" href="../Materialize/css/Style.css">
	<script src="../js/jQuery.js"></script>
	<script src="../js/jquery.maskedinput.js"></script>
	<script src="../Materialize/js/materialize.js"></script>
	<script src="../js/jsRiesgo.js"></script>
	<script src="../js/jsAnalisis.js"></script>
	<script src="../js/jsNivelRiesgo.js"></script>
	<script src="../js/jsAdministracion.js"></script>
	<script src="../js/jsUsuarios.js"></script>
	<script type="text/javascript" src="../js/jsSevri.js"></script>
	<script type="text/javascript" src="../js/jsCategoria.js"></script>
	<script type="text/javascript" src="../js/jsParametros.js"></script>
	<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
</head>
<body>
		<?php 
			include('../HeaderFooter/header.php');

		?>

		<main>
			<div class="preloader-wrapper big active posicionBarra" id="barraCargando" style="display:none">
		  <div class="spinner-layer spinner-blue">
		    <div class="circle-clipper left">
		      <div class="circle"></div>
		    </div><div class="gap-patch">
		      <div class="circle"></div>
		    </div><div class="circle-clipper right">
		      <div class="circle"></div>
		    </div>
		  </div>

		  <div class="spinner-layer spinner-red">
		    <div class="circle-clipper left">
		      <div class="circle"></div>
		    </div><div class="gap-patch">
		      <div class="circle"></div>
		    </div><div class="circle-clipper right">
		      <div class="circle"></div>
		    </div>
		  </div>

		  <div class="spinner-layer spinner-yellow">
		    <div class="circle-clipper left">
		      <div class="circle"></div>
		    </div><div class="gap-patch">
		      <div class="circle"></div>
		    </div><div class="circle-clipper right">
		      <div class="circle"></div>
		    </div>
		  </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
			<div id="contenedor" class="container contForm">
				
			</div>
		
			<div id="mRespuesta">

			</div>
	</main>
	
 		<?php 
			include('../HeaderFooter/footer.php');
		 ?>
</body>
</html>