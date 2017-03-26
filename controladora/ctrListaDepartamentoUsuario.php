<?php 
    class ctrListaDepartamentoUsuario{
        function ctrListaDepartamentoUsuario(){}

        function obtenerDepartamentoUsuario($idDepartamento){
			include_once ('../../data/dtDepartamentoUsuario.php');
			$dataDepaUsu = new dtDepartamentoUsuario();
			$lista = $dataDepaUsu->getDepartamentoUsuario($idDepartamento);
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
    }
?>