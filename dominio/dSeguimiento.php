<?php

	class dSeguimiento{

		private $id;
		private $porcentajeAvance;
		private $comentarioAvance;
		private $montoSeguimiento;
		private $fechaAvance;
		private $usuarioAprobador;
		private $estadoSeguimiento;
		private $comentarioAprobador;
		private $actividadTratamiento;
		private $archivo;

		public function dSeguimiento(){}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getPorcentajeAvance(){
			return $this->porcentajeAvance;
		}

		public function setPorcentajeAvance($porcentajeAvance){
			$this->porcentajeAvance=$porcentajeAvance;
		}

		public function getComentarioAvance(){
			return $this->comentarioAvance;
		}

		public function setComentarioAvance($comentarioAvance){
			$this->comentarioAvance=$comentarioAvance;
		}

		public function getMontoSeguimiento(){
			return $this->montoSeguimiento;
		}

		public function setMontoSeguimiento($montoSeguimiento){
			$this->montoSeguimiento=$montoSeguimiento;
		}

		public function getFechaAvance(){
			return $this->fechaAvance;
		}

		public function setFechaAvance($fechaAvance){
			$this->fechaAvance=$fechaAvance;
		}

		public function getUsuarioAprobador(){
			return $this->usuarioAprobador;
		}

		public function setUsuarioAprobador($usuarioAprobador){
			$this->usuarioAprobador=$usuarioAprobador;
		}

		public function getEstadoSeguimiento(){
			return $this->estadoSeguimiento;
		}

		public function setEstadoSeguimiento($estadoSeguimiento){
			$this->estadoSeguimiento=$estadoSeguimiento;
		}

		public function getComentarioAprobador(){
			return $this->comentarioAprobador;
		}

		public function setComentarioAprobador($comentarioAprobador){
			$this->comentarioAprobador=$comentarioAprobador;
		}

		public function getActividadTratamiento(){
			return $this->actividadTratamiento;
		}

		public function setActividadTratamiento($actividadTratamiento){
			$this->actividadTratamiento=$actividadTratamiento;
		}

		public function setArchivo($archivo) {
			$this->archivo = $archivo;
		}

		public function getArchivo() {
			return $this->archivo;
		}

	}

?>