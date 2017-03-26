<?php 
		
	class ctrListaAnalisis{

		function ctrListaAnalisis(){}

		function obtenerTodosAnalisis() {
			include_once ('../../data/dtAnalisis.php');
			$dataAnalisis = new dtAnalisis();
			$lista = $dataAnalisis->getTodosAnalisis();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function obtenerListaAnalisis(){
			include_once ('../../data/dtAnalisis.php');
			$dataAnalisis = new dtAnalisis();
			$lista = $dataAnalisis->getListaAnalisis();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function obtenerAnalisis($idAnalisis){
			include_once ('../../data/dtAnalisis.php');
			$dataAnalisis = new dtAnalisis();
			$analisis = $dataAnalisis->getAnalisis($idAnalisis);
			if(!$analisis){
				return false;
			}else{
				return $analisis;
			}
		}
	}

 ?>