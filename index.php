<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pagina Principal</title>
	<script src="js/jQuery.js"></script>
	
	<link rel="stylesheet" href="Materialize/css/materialize.css">
	<script src="Materialize/js/materialize.js"></script>
	<script type="text/javascript" src="js/jsPaginadorTablas.js?v=3"></script>
	<script src="js/jsUsuarios.js"></script>
	 <style>

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #fff;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #fff;
    }
  </style>
</head>
<?php 
	include('HeaderFooter/headerPaginaPrincipal.php');
?>
<body>
	
	<div class="slider">
	    <ul class="slides">
	      <li class="colorSlider1">
	        <div class="caption center-align">
	          <h4>Municipalidad de Sarapiqu&iacute</h4>
	          <h5>Al servicio del cant&oacuten</h5>
	        </div>
	      </li>
	      <li class="colorSlider2">
	        <div class="caption left-align">
	          <h3>Visi&oacuten</h3>
	          <h5 class="light grey-text text-lighten-3">"Visualizar un Cantón progresista y saludable que dirige sus acciones a 
	          	satisfacer las necesidades de sus habitantes y se convierta en el eje principal de desarrollo, garantizando con el 
	          	apoyo de un recurso humano capacitado, la consolidación administrativa y financiera para una mejor calidad de vida de 
	          	nuestros habitantes. La Municipalidad se caracterizará por la mística de los funcionarios y los servicios de calidad 
	          	que propician el desarrollo local sostenible en el Cantón."</h5>
	        </div>
	      </li>
	      <li class="colorSlider1">
	        <div class="caption left-align">
	          <h3>Misi&oacuten</h3>
	          <h5 class="light grey-text text-lighten-3">"Ser un gobierno local con autonomía propia, para el cumplimiento de sus fines, tal 
	          	y como lo establece el Código Municipal, gestora del desarrollo integral con capacidad de liderazgo, transparencia en sus 
	          	acciones, mediante una adecuada organización administrativa, financiera y social, que propicia la participación democrática 
	          	de sus ciudadanos en procura de una mejor calidad de vida de sus pobladores".</h5>
	        </div>
	      </li>
	      <li class="colorSlider2">
	        <div class="caption center-align">
	          <h3>¿Que es el SEVRI?</h3>
	          <h5 class="light grey-text text-lighten-3">Se entenderá como SEVRI al conjunto organizado de componentes de la institución que interaccionan 
	          	para la identificación, análisis, evaluación, administración, revisión, documentación y comunicación de los riesgos institucionales relevantes, 
	          	así descritos en la Circular D-3-2005-CO-DFOE de la Contraloría General de la República para el cumplimiento de los objetivos.</h5>
	        </div>
	      </li>
	    </ul>
  </div>
  <div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1 ">
            <div class="card-content white-text">
              <span class="card-title">Identificaci&oacuten</span>
              <p>Según las directrices de la Contraloría General de la República,
               se debe identificar los riesgos por áreas, sectores, actividades o tareas,
               de conformidad con las particularidades de la Institución. En este proceso se describe
               los eventos de índole interno y externo que pueden afectar de manera significativa el 
               cumplimiento de los objetivos fijados, así como las causas que inciden en la materialización 
               de dichos eventos, y las probables consecuencias.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card blue-grey darken-1 ">
            <div class="card-content white-text">
              <span class="card-title">An&aacutelisis</span>
              <p>Consiste en determinar el nivel de riesgo, considerando la probabilidad de ocurrencia y la
               consecuencia de los eventos identificados y los controles existentes. Se realiza una descripción 
               o estimación de la magnitud de las consecuencias potenciales, la probabilidad de que esas consecuencias 
               ocurran y el nivel de riesgo inherente.Para realizar este análisis de riesgos, se deben considerar los 
               criterios de evaluación determinados para la probabilidad y consecuencia. </p>
            </div>
          </div>
        </div>
         <div class="col s12 m6">
          <div class="card blue-grey darken-1 ">
            <div class="card-content white-text">
              <span class="card-title">Administraci&oacuten</span>
              <p>Actividad mediante la cual se identifican, evalúan, seleccionan y ejecutan las medidas para la 
              	administración de riesgos, se deben analizar y seleccionar las medidas de administración para cada 
              	riesgo, que afecten los factores de riesgos y permitan la minimización de ocurrencia o consecuencia de 
              	éste.  Los riesgos se agrupan según el tipo de tratamiento que se le vaya a asignar, a saber: atender, 
              	modificar, transferir, prevenir o retener; según lo definido en las directrices del SEVRI.</p>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card blue-grey darken-1 ">
            <div class="card-content white-text">
              <span class="card-title">Seguimiento</span>
              <p>En este proceso se debe revisar los factores de riesgo, a los controles y su efectividad y a las medidas 
              	de administración y su efectividad. La revisión sobre la marcha es esencial para asegurar que el plan de 
              	administración permanece relevante. Los factores que afectan la posibilidad y consecuencia de un resultado 
              	pueden cambiar, así como los factores que afectan la oportunidad, conveniencia o costo de las diferentes 
              	opciones de tratamiento. La revisión es una parte integral del plan de tratamiento de riesgo.</p>
            </div>
          </div>
        </div>
   </div>
      <!--Aqui se encuentra el modal del registro de usuario-->
      <div id="login" class="modal blue darken-3">
	
		 <div class="section"></div>
		      <div class="container">
			        <div class=" blue darken-3 row" style="display: inline-block;padding: 32px 48px 0 48px; margin-left:1px;width:100%;">
			
				          <form method="Post" action="accesoUsuario.php" class="col s12">
				          	<div class='row'>
					              <div class='col s12'>
										<img class="imagenUsuario"src="img/user2.png" alt="">
					              </div>
					            </div>
					            <div class='row'>
					              <div class='input-field col s12'>
						                <input class='validate white-text' type='text' name='usuario' id='usuario' />
						                <label for='usuario' class="white-text">Usuario</label>
					              </div>
					            </div>
					            <div class='row'>
						            <div class='input-field col s12'>
							            <input class='validate white-text' type='password' name='clave' id='clave' />
							            <label for='clave' class="white-text">Clave</label>
						            </div>
					            </div>
					            <center>
						            <div class='row'>
						               <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Ingresar</button>
						            </div>
					            </center>
				          </form>
			        </div>
	      		</div>
    
					    
		</div>	

	<!--

      <div id="login" class="modal blue darken-3 z-depth-5 white-text">
		<div class="modal-content" id="contenido">
			<div id="contenidoFormulario">
				<form id="ingresoSistema" method="Post" action="accesoUsuario.php">
					<div  id="inputsIngreso" >
						<h5>Ingreso al sistema</h5><br></br>
						<img src="img/user2.png" alt=""  >	
						<div>
							<label class="white-text" for="usuario">Usuario</label>
							<input class="white-text" type="text" name="usuario" id="usuario" style="text-align: center;width: 100%;">
						</div>
 						<div>
 							<label class="white-text" for="clave">Clave</label>
							<input class="white-text" type="password" name="clave" id="clave" style="text-align: center; width: 100%;">
						</div>
					</div>
					
	 				<button type="submit" class="btn waves-effect waves-light" >Ingresar</button>
				</form>	
			</div>			    
		</div>	
	</div>	 -->
	<script>
		$(document).ready(function(){
		   	$('.modal-trigger').leanModal();
		});
				
	</script>
	 <!--Aqui termina el modal del registro de usuario-->
<?php 
	include('HeaderFooter/footer.php');
?>
</body>
 <script>
  $(document).ready(function(){
      $('.slider').slider();
    });
  </script>
</html>
