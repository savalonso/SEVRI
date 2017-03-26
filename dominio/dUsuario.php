<?php 

	class dUsuario{
		private $cedula;
		private $nombre;
		private $fechaRegistro;
		private $telefono;
		private $correo;
		private $cargo;
		private $tipo;

		public function dUsuario(){}

		public function getCedula(){
			return $this->cedula;
		}

		public function setCedula($cedula){
			$this->cedula = $cedula;
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getFechaRegistro(){
			return $this->fechaRegistro;
		}

		public function setFechaRegistro($fechaRegistro){
			$this->fechaRegistro = $fechaRegistro;
		}

		public function getTelefono(){
			return $this->telefono;
		}

		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function getCorreo(){
			return $this->correo;
		}

		public function setCorreo($correo){
			$this->correo = $correo;
		}

		public function getCargo(){
			return $this->cargo;
		}

		public function setCargo($cargo){
			$this->cargo = $cargo;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}
		
	}

 ?>