<?php

  class dRiesgo {

    private $id;
  	private $midDepartamento;
  	private $midCategoria;
    private $mnombre;
    private $mdescripcion;
    private $mmontoEconomico;
    private $mestaActivo;
    private $mcausa;
    private $mfecha;
    private $mDominio;

  	function dSevri(){
  	}
    public function getId(){
      return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }
  	public function getIdDepartamento(){
  		return $this->midDepartamento;
  	}
  	public function setIdDepartamento($pidDepartamento){
  		$this->midDepartamento = $pidDepartamento;
  	}
  	public function getIdCategoria(){
  		return $this->midCategoria;
  	}
  	public function setIdCategoria($pidCategoria){
  		$this->midCategoria = $pidCategoria;
  	}
    public function getNombre(){
      return $this->mnombre;
    }
    public function setNombre($pnombre){
      $this->mnombre = $pnombre;
    }
    public function getDescripcion(){
      return $this->mdescripcion;
    }
    public function setDescripcion($pdescripcion){
      $this->mdescripcion = $pdescripcion;
    }
    public function getMontoEconomico(){
      return $this->mmontoEconomico;
    }
    public function setMontoEconomico($pmontoEconomico){
      $this->mmontoEconomico = $pmontoEconomico;
    }
    public function getEstaActivo(){
      return $this->mestaActivo;
    }
    public function setEstaActivo($pestaActivo){
      $this->mestaActivo = $pestaActivo;
    }
    public function getCausa(){
      return $this->mcausa;
    }
    public function setCausa($pcausa){
      $this->mcausa = $pcausa;
    }
    public function getFecha(){
      return $this->mfecha;
    }
    public function setFecha($mfecha){
      $this->mfecha = $mfecha;
    }

    public function getDominio(){
      return $this->mDominio;
    }
    public function setDominio($mDominio){
      $this->mDominio = $mDominio;
    }
  }
?>