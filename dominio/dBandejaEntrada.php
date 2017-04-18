<?php 

class dBandejaEntrada{

	private $nombreRemitente;
	private $mensaje;
	private $direccionPagina;
	private $idMensaje;
	private $esNuevo;

	public function dBandejaEntrada(){}

	public function getNombreRemitente(){
		return $this->nombreRemitente;
	}

	public function setNombreRemitente($nombre){
		$this->nombreRemitente = $nombre; 
	}

	public function getMensaje(){
		return $this->mensaje;
	}

	public function setMensaje($mensaje){
		$this->mensaje = $mensaje; 
	}

	public function getDireccionPagina(){
		return $this->direccionPagina;
	}

	public function setDireccionPagina($direccionPagina){
		$this->direccionPagina = $direccionPagina; 
	}

	public function getIdMensaje(){
		return $this->idMensaje;
	}

	public function setIdMensaje($idMensaje){
		$this->idMensaje = $idMensaje; 
	}

	public function getEsNuevo(){
		return $this->esNuevo;
	}

	public function setEsNuevo($esNuevo){
		$this->esNuevo = $esNuevo;
	}
}

 ?>