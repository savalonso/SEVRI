<?php 

	class dNivelRiesgo{

		private $idNivel;
		private $idDivisiones;
		private $cantidadDivisiones;
		private $nombreDiviciones;
		private $limite;
		private $descriptor;
		private $descripcion;
		private $color;
		private $esEditable;

		public function dNivelRiesgo(){}

		public function getIdNivel(){
			return $this->idNivel;
		}

		public function setIdNivel($idNivel){
			$this->idNivel = $idNivel;
		}

		public function getIdDivisiones(){
			return $this->idDivisiones;
		}

		public function setIdDivisiones($idDivisiones){
			$this->idDivisiones = $idDivisiones;
		}

		public function getCantidadDivisiones(){
			return $this->cantidadDivisiones;
		}

		public function setCantidadDivisiones($cantidadDivisiones){
			$this->cantidadDivisiones = $cantidadDivisiones;
		}

		public function getLimite(){
			return $this->limite;
		}

		public function setLimite($limite){
			$this->limite = $limite;
		}

		public function getDescriptor(){
			return $this->descriptor;
		}

		public function setDescriptor($descriptor){
			$this->descriptor = $descriptor;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}

		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getColor(){
			return $this->color;
		}

		public function setColor($color){
			$this->color = $color;
		}
		public function getNombreDiviciones(){
			return $this->nombreDiviciones;
		}

		public function setNombreDiviciones($nombreDiviciones){
			$this->nombreDiviciones = $nombreDiviciones;
		}

		public function getEsEditable(){
			return $this->esEditable;
		}

		public function setEsEditable($esEditable){
			$this->esEditable = $esEditable;
		}

	}

 ?>