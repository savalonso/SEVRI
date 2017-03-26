<?php

  class dDepartamentoUsuario {

    function dDepartamentoUsuario(){}

    private $IdDepartamento;
    private $CedulaUsuario;

    public function getIdDepartamento(){
      return $this->IdDepartamento;
    }
    public function setIdDepartamento($IdDepartamento){
      $this->IdDepartamento = $IdDepartamento;
    }
    public function getCedulaUsuario(){
      return $this->CedulaUsuario;
    }
    public function setCedulaUsuario($CedulaUsuario){
      $this->CedulaUsuario = $CedulaUsuario;
    }
  }
?>