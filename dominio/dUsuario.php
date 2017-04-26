<?php 

	class dUsuario{
		private $cedula;
		private $nombre;
		private $primerApellido;
    	private $segundoApellido;
		private $fechaRegistro;
		private $telefono;
		private $correo;
		private $clave;
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

		public function getPrimerApellido(){
	      return $this->primerApellido;
	    }

	    public function setPrimerApellido($primerApellido){
	      $this->primerApellido = $primerApellido;
	    }

	    public function getSegundoApellido(){
	      return $this->segundoApellido;
	    }

	    public function setSegundoApellido($segundoApellido){
	      $this->segundoApellido = $segundoApellido;
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

		public function getClave(){
	      return $this->clave;
	    }
	    
	    public function setClave($clave){
	      $this->clave = $clave;
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