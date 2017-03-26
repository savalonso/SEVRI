<?php
 	class dCategoria{
 		private $mNombreCategoria;
 		private $mIdCategoria;
 		private $mDescripcion;
 		private $mHijoDe;
 		private $mcantHijos;
 		private $mcantRiesgos;

 		function dDepartamento(){}

 	    public function getNombreCategoria(){
  			return $this->mNombreCategoria;
  	 	}
	  	public function setNombreCategoria($pnombre){
	  		$this->mNombreCategoria = $pnombre;
	  	}
	  	public function getIdCategoria(){
  			return $this->mIdCategoria;
  	 	}
	  	public function setIdCategoria($pIdCategoria){
	  		$this->mIdCategoria = $pIdCategoria;
	  	}
	  	public function getDescripcion(){
  			return $this->mDescripcion;
  	 	}
	  	public function setDescripcion($pdescripcion){
	  		$this->mDescripcion = $pdescripcion;
	  	}
	  	public function getHijoDe(){
  			return $this->mHijoDe;
  	 	}
	  	public function setHijoDe($mHijoDe){
	  		$this->mHijoDe = $mHijoDe;
	  	}
	  	public function getCantHijos(){
  			return $this->mcantHijos;
  	 	}
	  	public function setCantHijos($mcantHijos){
	  		$this->mcantHijos = $mcantHijos;
	  	}
	  	public function getCantRiesgos(){
  			return $this->mcantRiesgos;
  	 	}
	  	public function setCantRiesgos($mcantRiesgos){
	  		$this->mcantRiesgos = $mcantRiesgos;
	  	}
 	}

?>