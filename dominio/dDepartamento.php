<?php

 	class dDepartamento{

 		private $mcodigoDepartamento;
 		private $mnombreDepartamento;
 		private $mfechaCreacion;
 		private $midDepartamento;

 		function dDepartamento(){}

 	    public function getCodigoDepartamento(){
  			return $this->mcodigoDepartamento;
  	 	}
	  	public function setCodigoDepartamento($pcodigo){
	  		$this->mcodigoDepartamento = $pcodigo;
	  	}
	  	public function getNombreDepartamento(){
  			return $this->mnombreDepartamento;
  	 	}
	  	public function setNombreDepartamento($pnombre){
	  		$this->mnombreDepartamento = $pnombre;
	  	}
	  	public function getFechaCreacion(){
  			return $this->mfechaCreacion;
  	 	}
	  	public function setFechaCreacion($pfecha){
	  		$this->mfechaCreacion = $pfecha;
	  	}
	  	public function getIdDepartamento(){
  			return $this->midDepartamento;
  	 	}
	  	public function setIdDepartamento($pid){
	  		$this->midDepartamento = $pid;
	  	}
 	}

?>