<?php 

class dBandejaEntrada{

	private $nombreRemitente;
	private $mensaje;
	private $direccionPagina;

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
}

 ?>