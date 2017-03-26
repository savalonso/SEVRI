<?php
    include_once ('dtConnection.php');

    class dtDepartamentoUsuario{
        function dtDepartamentoUsuario(){}

		function insertarDepartamentoUsuario($depaUsu){
            include_once ('dtConnection.php');
			$con = new dtConnection;
			$prueba = $con->conect();

            $idDepartamento = $depaUsu->getIdDepartamento();
            $cedulaUsuario = $depaUsu->getCedulaUsuario();

            $result = $prueba->query("CALL insertarDepartamentoUsuario($idDepartamento, $cedulaUsuario)");
			if (!$result){
				return false;
			} else {
				return true;
			}
        }

        function getDepartamentoUsuario($idDepartamento){
			
			include_once("../../dominio/dDepartamentoUsuario.php");
			$con = new dtConnection;
			$conexion = $con->conect();
			$query = "CALL obtenerDepartmentoUsuario($idDepartamento)";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$depaUsu = new dDepartamentoUsuario();
                $depaUsu->setIdDepartamento($row['IdDepartamento']);
                $depaUsu->setCedulaUsuario($row['CedulaUsuario']);
                array_push($lista, $depaUsu);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function eliminarUsuarioDepartamento($idDepartamento, $cedulaUsuario){
			$con = new dtConnection;
			$prueba = $con->conect();
			$result = $prueba->query("CALL eliminarUsuarioDepartamento($idDepartamento, $cedulaUsuario);");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}
    }
?>