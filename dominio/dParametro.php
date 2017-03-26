<?php

	class dParametro{

		private $mvalorParametro;
		private $mdescriptorParametro;
		private $mdescripcionParametro;
		private $mnombreParametro;
		private $midParametro;
		private $mcolorParametro;
		private $mEsModificable;

		function dParametro(){}

		public function getValorParametro(){
  			return $this->mvalorParametro;
  	 	}
	  	public function setValorParametro($pvalor){
	  		$this->mvalorParametro = $pvalor;
	  	}
	  	public function getDescriptorParametro(){
  			return $this->mdescriptorParametro;
  	 	}
	  	public function setDescriptorParametro($pdescriptor){
	  		$this->mdescriptorParametro = $pdescriptor;
	  	}
	  	public function getDescripcionParametro(){
  			return $this->mdescripcionParametro;
  	 	}
	  	public function setDescripcionParametro($pdescripcion){
	  		$this->mdescripcionParametro = $pdescripcion;
	  	}
	  	public function getNombreParametro(){
  			return $this->mnombreParametro;
  	 	}
	  	public function setNombreParametro($pnombre){
	  		$this->mnombreParametro = $pnombre;
	  	}
	  	public function getIdParametro(){
  			return $this->midParametro;
  	 	}
	  	public function setIdParametro($pidparametro){
	  		$this->midParametro = $pidparametro;
	  	}
	  	public function getColorParametro(){
  			return $this->mcolorParametro;
  	 	}
	  	public function setColorParametro($pcolorParametro){
	  		$this->mcolorParametro = $pcolorParametro;
	  	}
	  	public function getEsModificable(){
  			return $this->mEsModificable;
  	 	}
	  	public function setEsModificable($pEsModificable){
	  		$this->mEsModificable = $pEsModificable;
	  	}
	}

?>