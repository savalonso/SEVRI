<?php 
	include("../dominio/dRiesgo.php");
	include("../data/dtRiesgo.php");
	class ctrSevri {
		
		function ctrRiesgo(){}

		function insertarRiesgo(){
	      	$mriesgo = new dRiesgo;

    		$mriesgo->setIdDepartamento('1');
    		$mriesgo->setIdCategoria($_POST['sub']);
	      	$mriesgo->setNombre($_POST['nombre']);
	      	$mriesgo->setDescripcion($_POST['descripcion']);
	      	$montoTemp =str_replace(".","",$_POST['monto']);
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
    		//echo("alert(\"Llego a la controladora con: \"+$idRiesgo");
	      	$dataRiesgo = new dtRiesgo;
               
	      	if($dataRiesgo->eliminarRiesgo($idRiesgo) == true){
	      		echo 
	      		'	
	      			Se ha eliminado correctamente el riesgo.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido eliminar el riesgo.
	      		';
	      	}
		}
		function modificarRiesgo(){
	      	$mriesgo = new dRiesgo;
	      	$mriesgo->setId($_POST['id']);
    		$mriesgo->setIdDepartamento("1");
    		$mriesgo->setIdCategoria($_POST['subcategoria']);
	      	$mriesgo->setNombre($_POST['nombre']);
	      	$mriesgo->setDescripcion($_POST['descripcion']);
	      	$montoTemp =str_replace(".","",$_POST['monto']);
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
	$control = new ctrSevri;
	if($op == 1){
	 	$control->insertarRiesgo();
	}
	if($op == 2){
	 	$control->obtenerRiesgo();
	}
	if($op == 3){
	 	$control->eliminarRiesgo();
	}
	if($op == 4){
	 	$control->modificarRiesgo();
	}
?>