<?php 

	class ctrListaNivelRiesgo{

		public function ctrListaNivelRiesgo(){}

		function ObtenerNivelRiesgo(){
			include_once("../../logica/logicaNivelRiesgo.php");
			$logica = new logicaNivelRiesgo();
	      	$resultado = $logica->obtenerNivelRiesgo();
	      	if(!$resultado){
	      		return false;
	      	}else{
	      		return $resultado;
	      	}
			
		}
		function ObtenerNiveLRiesgoFiltrado(){
			include_once("../../logica/logicaNivelRiesgo.php");
			$logica = new logicaNivelRiesgo();
	      	$resultado = $logica->obtenerNivelRiesgoFiltrado();
	      	if(!$resultado){
	      		return false;
	      	}else{
	      		return $resultado;
	      	}
		}
		function ObtenerDivicionNivel(){
			include_once("../../logica/logicaNivelRiesgo.php");
			$logica = new logicaNivelRiesgo();
	      	$resultado = $logica->obtenerDiviciones();
	      	if(!$resultado){
	      		return false;
	      	}else{
	      		return $resultado;
	      	}
		}
		function ObtenerNivelRiesgoViculado(){
			include_once("../../logica/logicaNivelRiesgo.php");
			$logica = new logicaNivelRiesgo();
	      	$resultado = $logica->ObtenerNivelRiesgoViculado();
	      	if(!$resultado){
	      		return false;
	      	}else{
	      		return $resultado;
	      	}
		}
	}

 ?>