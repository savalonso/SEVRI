<?php 

	class dMedidaAdministracion{
		private $id;
		private $nombreMedida;
		private $descripcionMedida;

		public function dMedidaAdministracion(){}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getNombreMedida(){
			return $this->nombreMedida;
		}

		public function setNombreMedida($nombreMedida){
			$this->nombreMedida = $nombreMedida;
		}

		public function getDescripcionMedida(){
			return $this->descripcionMedida;
		}

		public function setDescripcionMedida($descripcionMedida){
			$this->descripcionMedida = $descripcionMedida;
		}
	}

 ?>