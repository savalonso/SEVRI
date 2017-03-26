<?php 
		
	class ctrListaDepartamento{

		function ctrListaDepartamento(){}

		function obtenerListaDepartamento(){
			include_once("../../logica/logicaDepartamento.php");
			$lDepartamento = new logicaDepartamento();

			$lista = $lDepartamento->traerDepartamentos();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerDepartamento($idDepartamento){
			include_once("../../data/dtDepartamento.php");
			$dataDepartamento = new dtDepartamento();
			$departamento = $dataDepartamento->getDepartamento($idDepartamento);
			if(!$departamento){
				return false;
			}else{
				return $departamento;
			}
		}
		function mostrarDepartamentos(){
			include_once('../../logica/LogicaDepartamento.php');
			$lDepartamento = new LogicaDepartamento();
			$lista = $lDepartamento->obtenerDepartamentosFiltrados();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
	}

 ?>