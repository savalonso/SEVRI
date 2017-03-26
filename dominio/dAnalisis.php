<?php

  class dAnalisis {

    private $id;
  	private $idRiesgo;
  	private $probabilidad;
    private $impacto;
    private $nivelRiesgo;
    private $medidaControl;
    private $calificacionMedida;

  	function dAnalisis(){
  	}
    public function getId(){
      return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }
  	public function getIdRiesgo(){
  		return $this->idRiesgo;
  	}
  	public function setIdRiesgo($pidRiesgo){
  		$this->idRiesgo = $pidRiesgo;
  	}
  	public function getProbabilidad(){
  		return $this->probabilidad;
  	}
  	public function setProbabilidad($pProbabilidad){
  		$this->probabilidad = $pProbabilidad;
  	}
    public function getImpacto(){
      return $this->impacto;
    }
    public function setImpacto($pImpacto){
      $this->impacto = $pImpacto;
    }
    public function getNivelRiesgo(){
      return $this->nivelRiesgo;
    }
    public function setNivelRiesgo($pNivelRiesgo){
      $this->nivelRiesgo = $pNivelRiesgo;
    }
    public function getMedidaControl(){
      return $this->medidaControl;
    }
    public function setMedidaControl($pMedidaControl){
      $this->medidaControl = $pMedidaControl;
    }
    public function getCalificacionMedida(){
      return $this->calificacionMedida;
    }
    public function setCalificacionMedida($pCalificacionMedida){
      $this->calificacionMedida = $pCalificacionMedida;
    }
  }
?>