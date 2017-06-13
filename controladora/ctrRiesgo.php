<?php 
	include("../dominio/dRiesgo.php");
	include("../data/dtRiesgo.php");
	
	class ctrRiesgo {
		
		function ctrRiesgo(){}

		function insertarRiesgo(){

	      	$mriesgo = new dRiesgo;

    		$mriesgo->setIdDepartamento($_POST['idDepartamento']);
    		$mriesgo->setIdCategoria($_POST['sub']);
	      	$mriesgo->setNombre($_POST['nombre']);
	      	$mriesgo->setDescripcion($_POST['descripcion']);
	      	$montoTemp =str_replace(".","",$_POST['montoE']);
	      	$mriesgo->setMontoEconomico(str_replace("₡","",$montoTemp));
	      	$mriesgo->setEstaActivo($_POST['estado']);
	      	$mriesgo->setCausa($_POST['causa']);

	      	$dataRiesgo = new dtRiesgo;
               
	      	if($dataRiesgo->insertarRiesgo($mriesgo) == true){
	      		echo 
	      		'
	      			Se ha insertado correctamente el riesgo.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido insertar el riesgo.
	      		';
	      	}
		}

		function obtenerRiesgo(){
			$idRiesgo->$_POST['idRiesgo'];
			$dtRiesgo = new dtRiesgo;
			$lista =$dtRiesgo->getRiesgo($idRiesgo);
			
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function eliminarRiesgo(){
    		$idRiesgo = $_POST['idRiesgo'];
	      	$dataRiesgo = new dtRiesgo;
               
	      	if($dataRiesgo->eliminarRiesgo($idRiesgo) == true){
	      		echo 
	      		'	
	      			Se ha eliminado correctamente el riesgo.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			No se puede elliminar, este riesgo ha sido analizado. 
	      		';
	      	}
		}

		function generarReporte(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteRiesgoExcel();
		}

		function modificarRiesgo(){
	      	$mriesgo = new dRiesgo;
	      	$mriesgo->setId($_POST['id']);
	      	$mriesgo->setIdDepartamento($_POST['idDepartamento']);
    		$mriesgo->setIdCategoria($_POST['sub']);
	      	$mriesgo->setNombre($_POST['nombre']);
	      	$mriesgo->setDescripcion($_POST['descripcion']);
	      	$montoTemp =str_replace(".","",$_POST['montoE']);
	      	$mriesgo->setMontoEconomico(str_replace("₡","",$montoTemp));
	      	$mriesgo->setEstaActivo($_POST['estado']);
	      	$mriesgo->setCausa($_POST['causa']);
	      	$dataRiesgo = new dtRiesgo;
               
	      	if($dataRiesgo->modificarRiesgo($mriesgo) == true){
	      		echo 
	      		'	
	      			Se ha modificado correctamente el riesgo.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido modificar el riesgo.
	      		';
	      	}
		}
	}

	$op = $_POST['opcion'];
	$control = new ctrRiesgo;
	if($op == 1){
	 	$control->insertarRiesgo();
	}
	else if($op == 2){
	 	$control->obtenerRiesgo();
	}
	else if($op == 3){
	 	$control->eliminarRiesgo();
	}
	else if($op == 4){
	 	$control->modificarRiesgo();
	}
	else if($op == 5){
	 	$control->generarReporte();
	}
?>