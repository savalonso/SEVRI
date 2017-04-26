<?php 
		
	class ctrListaDepartamento{

		function ctrListaDepartamento(){}

		

		function obtenerListaDepartamento(){
			include_once("../../logica/logicaDepartamentos.php");
			$lDepartamento = new logicaDepartamentos();

			$lista = $lDepartamento->traerDepartamentos();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function obtenerListaDepartamentosUsuario($cedula){

			include_once('../../logica/LogicaDepartamentos.php');
			$lDepartamento = new logicaDepartamentos();
			$lista=$lDepartamento->obtenerDepartamentosUsuario($cedula);

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
			include_once('../../logica/LogicaDepartamentos.php');
			$lDepartamento = new LogicaDepartamentos();
			$lista = $lDepartamento->obtenerDepartamentosFiltrados();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function obtenerDepartamentosSeguimiento(){
			include_once('../../logica/logicaDepartamentos.php');
			$lDepartamento=new logicaDepartamentos();
			$lista=$lDepartamento->obtenerDepartamentosSeguimientos();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerDepartamentosVersionesAntiguas(){
			include_once('../../logica/logicaDepartamentos.php');
			$lDepartamento=new logicaDepartamentos();
			$lista=$lDepartamento->obtenerDepartamentosVersionesAntiguas();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
	}

 ?>