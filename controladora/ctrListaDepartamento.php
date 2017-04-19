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
		function obtenerListaDepartamentosUsuario($cedula){

			include_once("../../logica/logicaDepartamentos.php");
			$lDepartamento = new logicaDepartamentos();
			$lista=$lDepartamento->getDepartamentosUsuario($cedula);

			if(!$lista){
				return false;
			}else{
				return $lista;
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
		function obtenerDepartamentosVersionesAntiguas(){

			include_once("../../logica/logicaDepartamentos.php");
			$lDepartamento = new logicaDepartamentos();
			$lista=$lDepartamento->getDepartamentosVersionesAntiguas();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
	}

 ?>