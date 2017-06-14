<?php 
include_once ("../dominio/dAnalisis.php");
include_once ("../data/dtAnalisis.php");

class ctrAnalisis {
	
	function ctrAnalisis(){}
	
	function insertarAnalisis(){

		$analisis = new dAnalisis;
		$analisis->setIdRiesgo($_POST['riesgo']);
		$analisis->setProbabilidad($_POST['probabilidad']);
		$analisis->setImpacto($_POST['impacto']);
		$analisis->setMedidaControl($_POST['MedidaControl']);
		$analisis->setCalificacionMedida($_POST['CalificacionMedida']);
		$dataAnalisis = new dtAnalisis;
		
		if($dataAnalisis->insertarAnalisis($analisis) == true){
			echo 'Se ha insertado correctamente el an&aacutelisis.';
		} else {
			echo 'No se ha insertado el an&aacutelisis.';
		}
	}
	
	
	function actualizarAnalisis(){
		
		$analisis = new dAnalisis();
		$analisis->setProbabilidad($_POST['probabilidad']);
		$analisis->setImpacto($_POST['impacto']);
		$analisis->setMedidaControl($_POST['MedidaControl']);
		$analisis->setCalificacionMedida($_POST['CalificacionMedida']);
		$id = $_POST['id'];
		$dataAnalisis = new dtAnalisis();
		
		if($dataAnalisis->actualizarAnalisis($analisis,$id) == true){
			echo 'Se ha modificado correctamente el an&aacutelisis.';
		} else {
			echo 'No se ha modificado el an&aacutelisis.';
		}
	}
	
	
	function eliminarAnalisis(){
		
		$idAnalisis = $_POST['idAnalisis'];
		$dataAnalisis = new dtAnalisis;
		
		if($dataAnalisis->eliminarAnalisis($idAnalisis) == true){
			echo 'Se ha eliminado correctamente el an&aacutelisis.';	
		} else {
			echo 'No se elimin&oacute el an&aacutelisis, porque cunta con una adminstraci&oacuten';
		}
	}
	
}


$op = $_POST['opcion'];
$control = new ctrAnalisis;

if($op == 1){	
	$control->insertarAnalisis();
}
if($op == 2){	
	$control->actualizarAnalisis();
}
if($op == 3){	
	$control->eliminarAnalisis();
}

?>