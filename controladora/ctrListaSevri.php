<?php 
	
	class ctrListaSevri{

		function ctrListaSevri(){}

		function obtenerListaSevri(){
			include_once ('../../data/dtSevri.php');
			$dataSevri = new dtSevri();
			$lista = $dataSevri->getListaSevri(1);

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerListaSevriAntiguos(){
			include_once ('../../data/dtSevri.php');
			$dataSevri = new dtSevri();
			$lista = $dataSevri->getListaSevriAntiguos();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerSevri($idSevri){
			include_once ('../../data/dtSevri.php');
			$dataSevri = new dtSevri();
			$sevri = $dataSevri->getSevri($idSevri);
			if(!$sevri){
				return false;
			}else{
				return $sevri;
			}
		}
		function obtenerIdSevriActivo(){
			include_once('../logica/logicaSevri.php');
			$logica = new LogicaSevri();
			$idSevriActivo = $logica->obtenerIdSevriActivo();

			if(empty($idSevriActivo)){
				return false;
			}else{
				return true;
			}
			
		}
	}

 ?>