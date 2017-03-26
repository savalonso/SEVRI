<?php 

	class ctrNivelRiesgo{

		public function ctrNivelRiesgo(){}

		function insertarNivelesRiesgo(){
			include_once("../logica/logicaNivelRiesgo.php");
			include_once("../dominio/dNivelRiesgo.php");

			$logica = new logicaNivelRiesgo;

	      	$listaNiveles = json_decode($_POST['nivelesRiesgoJSON']);
	      	$resultado = $logica->insertarNivelRiesgo($listaNiveles);
			echo $resultado;
		}

		function modificarNivelesRiesgo(){
			include_once("../logica/logicaNivelRiesgo.php");
			include_once("../dominio/dNivelRiesgo.php");

			$logica = new logicaNivelRiesgo;

	      	$listaNiveles = json_decode($_POST['nivelesRiesgoJSON']);
	      	$resultado = $logica->modificarNivelRiesgo($listaNiveles);
			echo $resultado;
		}

		function eliminarNivelesRiesgo(){
			include_once("../logica/logicaNivelRiesgo.php");
			include_once("../dominio/dNivelRiesgo.php");

			$logica = new logicaNivelRiesgo;

	      	$idDivision = $_POST['idDivision'];
	      	$resultado = $logica->eliminarNivelesRiesgo($idDivision);
			echo $resultado;
		}

		public function vincularNivelRiesgo(){
			include_once("../logica/logicaNivelRiesgo.php");

	      	$idDivicion = $_POST['id'];
	      	$logicaNivel = new logicaNivelRiesgo();
           	$Respuesta = array();    
	      	if($logicaNivel->insertarSevriNivel($idDivicion) == true){
	      		
	      		$Respuesta[] = array('inserto' => 1,
                   					 'mensaje' => "Se ha vinculado correctamente el nivel de riesgo");	

	      		echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		
	      		$Respuesta[] = array('inserto' => 0,
                   					 'mensaje' => "No se ha podido vincular el nivel de riesgo");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		public function desvincularNivelRiesgo(){
			include_once("../logica/logicaNivelRiesgo.php");

	      	$idDivicion = $_POST['id'];
	      	$logicaNivel = new logicaNivelRiesgo();
           	$Respuesta = array();    
	      	if($logicaNivel->eliminarSevriNivel($idDivicion) == true){
	      		$Respuesta[] = array('elimino' => 1,
                   					 'mensaje' => "Se ha desvinculado correctamente el nivel de riesgo");	

	      		echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		$Respuesta[] = array('elimino' => 0,
                   					 'mensaje' => "No se ha podido desvincular el nivel de riesgo");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}
	}

	$op = $_POST['opcion'];
	$control = new ctrNivelRiesgo();
	if($op == 1){
	 	$control ->insertarNivelesRiesgo();
	}
	else if($op == 2){
	 	$control->vincularNivelRiesgo();
	}
	else if($op == 3){
	 	$control->desvincularNivelRiesgo();
	}
	else if($op == 4){
	 	$control->modificarNivelesRiesgo();
	}
	else if($op == 5){
	 	$control->eliminarNivelesRiesgo();
	}
 ?>