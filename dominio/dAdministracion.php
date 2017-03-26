<?php 

	class dAdministracion{
		private $id;
		private $usuario;
		private $actividadTratamiento;
		private $plazoTratamiento;
		private $costoActividad;
		private $indicador;
		private $medidaAdministracion;

		public function dAdministracion(){}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getUsuario(){
			return $this->usuario;
		}

		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}

		public function getActividadTratamiento(){
			return $this->actividadTratamiento;
		}

		public function setActividadTratamiento($actividadTratamiento){
			$this->actividadTratamiento = $actividadTratamiento;
		}

		public function getPlazoTratamiento(){
			return $this->plazoTratamiento;
		}

		public function setPlazoTratamiento($plazoTratamiento){
			$this->plazoTratamiento = $plazoTratamiento;
		}

		public function getCostoActividad(){
			return $this->costoActividad;
		}

		public function setCostoActividad($costoActividad){
			$this->costoActividad = $costoActividad;
		}

		public function getIndicador(){
			return $this->indicador;
		}

		public function setIndicador($indicador){
			$this->indicador = $indicador;
		}
		
		public function getMedidaAdministracion(){
			return $this->medidaAdministracion;
		}

		public function setMedidaAdministracion($medidaAdministracion){
			$this->medidaAdministracion = $medidaAdministracion;
		}
	}

 ?>