<?php 

	class ctrListaUsuario{

		public function ctrListaUsuario(){}

		public function obtenerNomCedUsuarios(){
			include_once('../../logica/logicaUsuario.php');
 			$logica = new logicaUsuario;
 			$lista = $logica->obtenerNomCedUsuarios();		
			return $lista;
		}

		function obtenerListaUsuarios(){
			include_once ('../../data/dtUsuario.php');
			$dataUsuario = new dtUsuario();
			$lista = $dataUsuario->getListaUsuarios();
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		function obtenerUsuario($cedula){
			include_once ('../../data/dtUsuario.php');
			$dataUsuario = new dtUsuario();
			$usuario = $dataUsuario->getUsuario($cedula);
			if(!$usuario){
				return false;
			}else{
				return $usuario;
			}
		}

		function obtenerMensajesUsuario(){
			include_once('../../logica/logicaUsuario.php');
 			$logica = new logicaUsuario;
 			$lista = $logica->obtenerMensajesUsuario();		
			return $lista;
		}

		function contarMensajesNuevos($cedula){
			include_once('../logica/logicaUsuario.php');
 			$logica = new logicaUsuario;
 			$cantidadMensajes = $logica->contarMensajesNuevos($cedula);		
			return $cantidadMensajes;
		}

	}

 ?>