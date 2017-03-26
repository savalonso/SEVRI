<?php 
		include_once ('../../data/dtRiesgo.php');
	class ctrListaRiesgo{

		function ctrListaRiesgo(){}

		function obtenerListaRiesgo(){

			$dataRiesgo = new dtRiesgo();
			$lista = $dataRiesgo->getListaRiesgo();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function obtenerRiesgo($idRiesgo){
			$dataRiesgo = new dtRiesgo();
			$riesgo = $dataRiesgo->getRiesgo($idRiesgo);
			if(!$riesgo){
				return false;
			}else{
				return $riesgo;
			}
		}

		function obtenerRiesgosAnalisados(){
			include_once('../../logica/logicaRiesgo.php');
 			$logica = new logicaRiesgo;
 			$lista = $logica->obtenerRiesgosAnalisados();		
			return $lista;
		}
		function obtenerRiesgosAntiguos(){

			$dataRiesgo = new dtRiesgo();
			$lista = $dataRiesgo->getRiesgosAntiguos();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

	}

 ?>