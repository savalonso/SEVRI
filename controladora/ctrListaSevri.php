<?php 
		include ('../../data/dtSevri.php');
	class ctrListaSevri{

		function ctrListaSevri(){}

		function obtenerListaSevri(){

			$dataSevri = new dtSevri();
			$lista = $dataSevri->getListaSevri(1);

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerListaSevriAntiguos(){

			$dataSevri = new dtSevri();
			$lista = $dataSevri->getListaSevriAntiguos();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerSevri($idSevri){
			$dataSevri = new dtSevri();
			$sevri = $dataSevri->getSevri($idSevri);
			if(!$sevri){
				return false;
			}else{
				return $sevri;
			}
		}
	}

 ?>