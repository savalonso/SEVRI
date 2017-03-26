<?php 
		
	class ctrListaParametro{

		function ctrListaParametro(){}

		function obtenerListaParametro(){
			include_once('../../logica/logicaSevri.php');
			$lSevri = new LogicaSevri();
			$lista = $lSevri->traerParametros();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerParametro($idParametro){
			include_once('../../data/dtParametro.php');
			$dataParametro = new dtParametro();
			$parametro = $dataParametro->getParametro($idParametro);
			if(!$parametro){
				return false;
			}else{
				return $parametro;
			}
		}
		function mostrarParametros(){
			include_once('../../logica/logicaSevri.php');
			$lSevri = new LogicaSevri();
			$lista = $lSevri->obtenerParametrosfiltrados();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
	}

 ?>