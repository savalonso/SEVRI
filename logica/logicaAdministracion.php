<?php 

	class logicaAdministracion{

		public function logicaAdministracion(){}

		public function getAdministracionResponsable($responsable){
			include_once('../../data/dtAdministracion.php');
			$data = new dtAdministracion;
			$lista = $data->getAdministracionResponsable($responsable);		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerMedidas(){
			include_once('../../data/dtAdministracion.php');
			$data = new dtAdministracion;
			$lista = $data->getMedidas();		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerAdministraciones($analisis){
			include_once('../../data/dtAdministracion.php');
			$data = new dtAdministracion;
			$lista = $data->getAdministraciones($analisis);		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerAdministracion($idAdministracion){
			include_once('../../data/dtAdministracion.php');
			$data = new dtAdministracion;
			$administracion = $data->getAdministracion($idAdministracion);		
			if(!$administracion){
				return false;
			}else{
				return $administracion;
			}
		}

		public function insertarAdministracion($administracion, $idAnalisis){
			include_once("../data/dtAdministracion.php");
			$dataAnalisis = new dtAdministracion;
			$mensaje = '';
			$resultado = $dataAnalisis->agregarAdministracion($administracion, $idAnalisis);
			if($resultado){
				$mensaje = 'Se ha realizado correctamente la administraci&oacuten del riesgo.';
			}else{
				$mensaje = 'No se ha realizado la administraci&oacuten del riesgo.';
			}
			return $mensaje;
		}

		public function actualizarAdministracion($administracion){
					
			include_once('../data/dtAdministracion.php');
			$data = new dtAdministracion();
			$resultado = $data->actualizarAdministracion($administracion);
				if(!$resultado){
					return false;
				}else{
					return true;
				}
		}

		public function eliminarAdmi($idAdministracion){
			include_once("../data/dtAdministracion.php");
			$data = new dtAdministracion();
			$resultado = $data->eliminarAdministracion($idAdministracion);

			if(!$resultado){
				return false;
			}else{
				return true;
			}

		}
	}

 ?>