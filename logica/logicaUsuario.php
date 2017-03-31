<?php 

	class logicaUsuario{

		public function logicaUsuario(){}

		public function obtenerNomCedUsuarios(){
			include_once('../../data/dtUsuario.php');
			$data = new dtUsuario;
			$lista = $data->get_Nom_Ced_Usuarios();		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerMensajesUsuario(){
			include_once('../../data/dtUsuario.php');
			$data = new dtUsuario;
			$lista = $data->getMensajesUsuario();		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function contarMensajesNuevos($cedula){
			include_once('../data/dtUsuario.php');
			$data = new dtUsuario;
			$cantidadMensajes = $data->getCantidadMensajesNuevos($cedula);		
			if(!$cantidadMensajes){
				return 0;
			}else{
				return $cantidadMensajes;
			}
		}

		public function marcarMensajeLeido($idMensaje){
			include_once('../data/dtUsuario.php');
			$data = new dtUsuario;
			$data->marcarMensajeLeido($idMensaje);	
		}
	}

 ?>