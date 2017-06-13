<?php
	
class dtSeguimiento{
	
	public function dtSeguimiento(){}
	

	public function insertarSeguimientoNuevo($seguimiento){
        include_once ('dtConnection.php');
        include_once("../dominio/dSeguimiento.php");
        $con = new dtConnection;
        $conexion = $con->conect();
        $query = "CALL obtenerUltimoIdSeguimiento()";

        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = $row['id'] + 1;

        $conexion = $con->crearConexionPDO();
        try {

           $idAdministracion = $seguimiento->getActividadTratamiento();
            $monto = $seguimiento->getMontoSeguimiento();
            $comentario = $seguimiento->getComentarioAvance();
            $porcentaje = $seguimiento->getPorcentajeAvance();
            $aprobador = $seguimiento->getUsuarioAprobador();
            $archivo = $seguimiento->getArchivo();
            $mensajeMostrar = substr($comentario, 0, 20);

            session_start();
            $creadorMensaje = $_SESSION['nombreUsuario'];
            $creadorMensaje.=" ".$_SESSION['apellidoUsuario'];
            $mensaje = "Te han asignado como aprobador del seguimiento: ".$mensajeMostrar;
            $url = "../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php";

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            $conexion->exec("CALL insertarSeguimientoNuevo('$idAdministracion', '$monto', '$comentario',  '$porcentaje', '$aprobador', '$archivo')");           
            $conexion->exec("CALL insertarMensajeUsuario('$creadorMensaje','$mensaje', '$url', '$aprobador', '$id', '2')");

            $conexion->commit();
            return true;
        } catch (Exception $e) {
            $conexion->rollback();
            return false;
        }

    }

    public function modificarSeguimiento($seguimiento) {
        include_once ('dtConnection.php');
        include_once("../dominio/dSeguimiento.php");
        $con = new dtConnection;
        $conexion = $con->conect();

        $conexion = $con->crearConexionPDO();
        try {
            
            $id =     $seguimiento->getId();
            $monto = $seguimiento->getMontoSeguimiento();
            $comentario = $seguimiento->getComentarioAvance();
            $porcentaje = $seguimiento->getPorcentajeAvance();
            $aprobador = $seguimiento->getUsuarioAprobador();
            $archivo = $seguimiento->getArchivo();
            $mensajeMostrar = substr($comentario, 0, 20);

            session_start();
            $creadorMensaje = $_SESSION['nombreUsuario'];
            $creadorMensaje.=" ".$_SESSION['apellidoUsuario'];
            $mensaje = "Te han asignado como aprobador del seguimiento: ".$mensajeMostrar;
            $url = "../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php";

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            $conexion->exec("CALL modificarSeguimiento('$id', '$monto', '$comentario', '$porcentaje', '$aprobador', '$archivo')");           
            $conexion->exec("CALL insertarMensajeUsuario('$creadorMensaje','$mensaje', '$url', '$aprobador', '$id', '2')");

            $conexion->commit();
            return true;
        } catch (Exception $e) {
            $conexion->rollback();
            return false;
        }
    }

    public function eliminarSeguimiento($id) {
        include_once ('dtConnection.php');
        $con = new dtConnection;
        $prueba = $con->conect();

        $result = $prueba->query("CALL eliminarSeguimiento($id)");
        if (!$result){
            return false;
        } else {
            return true;
        }
    }

    public function obtenerSeguimiento($idAdministracion){
        include_once ('dtConnection.php');
        include_once("../../dominio/dSeguimiento.php");
        $con = new dtConnection();
        $conexion = $con->conect();
        $query = "CALL obtenerSeguimiento($idAdministracion)";
        $result = mysqli_query($conexion, $query);
        $lista = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $seguimiento = new dSeguimiento;
            $seguimiento->setId($row['Id']);
			$seguimiento->setActividadTratamiento($row['IdAdministracionRiesgo']);
            $seguimiento->setMontoSeguimiento($row['MontoSeguimiento']);
            $seguimiento->setEstadoSeguimiento($row['EstaAprobado']);
            $seguimiento->setComentarioAprobador($row['ComentarioAprobador']);
            $seguimiento->setComentarioAvance($row['ComentarioAvance']);
            $seguimiento->setPorcentajeAvance($row['PorcentajeAvance']);
            $seguimiento->setFechaAvance($row['FechaAvance']);
            $seguimiento->setUsuarioAprobador($row['CedulaAprobador']);
            $seguimiento->setArchivo($row['Archivo']);
            array_push($lista, $seguimiento);
        }
        mysqli_free_result($result);
        mysqli_close($conexion);

        if (!$result){
            return false;
        } else {
            return $lista;
        }
    }

    public function obtenerSeguimientosPorIdAdministracion($idAdministracion){
        include_once ('dtConnection.php');
        include_once("../../dominio/dSeguimiento.php");
        $con = new dtConnection();
        $conexion = $con->conect();
        $query = "CALL obtenerSeguimientoPorIdAdministracion($idAdministracion)";
        $result = mysqli_query($conexion, $query);
        $lista = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $seguimiento = new dSeguimiento;
            $seguimiento->setId($row['Id']);
            $seguimiento->setMontoSeguimiento($row['MontoSeguimiento']);
            $seguimiento->setEstadoSeguimiento($row['estaAprobado']);
            $seguimiento->setComentarioAprobador($row['ComentarioAprobador']);
            $seguimiento->setComentarioAvance($row['ComentarioAvance']);
            $seguimiento->setPorcentajeAvance($row['PorcentajeAvance']);
            $seguimiento->setFechaAvance($row['FechaAvance']);
            $seguimiento->setUsuarioAprobador($row['Nombre'].' '.$row['PrimerApellido'].' '.$row['SegundoApellido']);
            array_push($lista, $seguimiento);
        }
        mysqli_free_result($result);
        mysqli_close($conexion);

        if (!$result){
            return false;
        } else {
            return $lista;
        }
    }

    public function obtenerSeguimientoReporte($idAdministracion){
        include_once ('dtConnection.php');
        include_once("../dominio/dSeguimiento.php");
        $con = new dtConnection();
        $conexion = $con->conect();
        $query = "CALL obtenerSeguimientoReporte($idAdministracion)";
        $result = mysqli_query($conexion, $query);
        $lista = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $seguimiento = new dSeguimiento;
            $seguimiento->setMontoSeguimiento($row['MontoSeguimiento']);
            $seguimiento->setComentarioAvance($row['ComentarioAvance']);
            $seguimiento->setPorcentajeAvance($row['PorcentajeAvance']);
            $seguimiento->setFechaAvance($row['FechaAvance']);
            array_push($lista, $seguimiento);
        }
        mysqli_free_result($result);
        mysqli_close($conexion);

        if (!$result){
            return false;
        } else {
            return $lista;
        }
    }

    public function obtenerAdministracionRiesgo($cedula){
        include_once ('dtConnection.php');
        include_once("../../dominio/dAdministracion.php");
        include_once("../../dominio/dAnalisis.php");
        include_once("../../dominio/dRiesgo.php");
        include_once("../../dominio/dMedidaAdministracion.php");

        $con = new dtConnection();
        $conexion = $con->conect();
        $query = "CALL obtenerAdministracionRiesgo($cedula)";
        $result = mysqli_query($conexion, $query);
        
        $listaAdministracion = array();
        $listaAnalisis = array();
        $listaRiesgo = array();
        $listaMedida = array();
        $lista = array();

        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            $administracion = new dAdministracion;
            $administracion->setId($row[0]);
            $administracion->setActividadTratamiento($row[4]);
            $administracion->setPlazoTratamiento($row[5]);
            $administracion->setCostoActividad($row[6]);
            $administracion->setIndicador($row[7]);
            array_push($listaAdministracion, $administracion);
            

            $analisis = new dAnalisis;
            $analisis->setMedidaControl($row[13]);
            array_push($listaAnalisis, $analisis);

            $riesgo = new dRiesgo;
            $riesgo->setNombre($row[19]);
            $riesgo->setCausa($row[23]);
            array_push($listaRiesgo, $riesgo);

            $medida = new dMedidaAdministracion;
            $medida->setNombreMedida($row[26]);
            array_push($listaMedida, $medida);

            array_push($lista, $listaAdministracion);
            array_push($lista, $listaAnalisis);
            array_push($lista, $listaRiesgo);
            array_push($lista, $listaMedida);
        }
        mysqli_free_result($result);
        mysqli_close($conexion);

        if (!$result){
            return false;
        } else {
            return $lista;
        }
	}
	
	function getSeguimientosAsignados($cedulaAprobador) {
		include_once('dtConnection.php');
		include_once("../../dominio/dSeguimiento.php");
		$con=new dtConnection();
		$conexion=$con->conect();
		$query="CALL obtenerSeguimientosAsignados('$cedulaAprobador')";
		$resultado=mysqli_query($conexion,$query);
		$lista=array();

		while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
			$seguimiento=new dSeguimiento;
			$seguimiento->setId($row[0]);
			$seguimiento->setActividadTratamiento($row[1]);
			$seguimiento->setPorcentajeAvance($row[2]);
			$seguimiento->setComentarioAvance($row[3]);
			$seguimiento->setMontoSeguimiento($row[4]);
			$seguimiento->setFechaAvance($row[5]);
			$seguimiento->setEstadoSeguimiento($row[6]);
			array_push($lista, $seguimiento);			
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		if (!$resultado){
			return false;
		} else {
			return $lista;
		}
	}

	function getSeguimientosAprobador($cedulaAprobador) {
		include_once('dtConnection.php');
		include_once("../../dominio/dSeguimiento.php");
		$con=new dtConnection();
		$conexion=$con->conect();
		$query="CALL obtenerSeguimientosAprobador('$cedulaAprobador')";
		$resultado=mysqli_query($conexion,$query);
		$lista=array();

		while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
			$seguimiento=new dSeguimiento;
			$seguimiento->setId($row[0]);
			$seguimiento->setPorcentajeAvance($row[1]);
			$seguimiento->setEstadoSeguimiento($row[2]);
			$seguimiento->setComentarioAprobador($row[3]);
			$seguimiento->setComentarioAvance($row[4]);
			$seguimiento->setMontoSeguimiento($row[5]);
			$seguimiento->setFechaAvance($row[6]);
			array_push($lista, $seguimiento);
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		if(!$resultado){
			return false;
		}else{
			return $lista;
		}
	}

	function getSeguimientoAprobador($idSeguimiento) {
		include_once('dtConnection.php');
		include_once("../../dominio/dSeguimiento.php");
		$con=new dtConnection();
		$conexion=$con->conect();
		$query="CALL obtenerSeguimientoAprobadorPorId('$idSeguimiento')";
		$resultado=mysqli_query($conexion,$query);
		$lista=array();

		while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
			$seguimiento=new dSeguimiento;
			$seguimiento->setId($row[0]);
			$seguimiento->setActividadTratamiento($row[1]);
			$seguimiento->setEstadoSeguimiento($row[2]);
			$seguimiento->setComentarioAprobador($row[3]);
			array_push($lista, $seguimiento);
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		if(!$resultado){
			return false;
		}else{
			return $lista;
		}
	}

	function getSeguimientosPorDepartamento($idDepartamento) {
		include_once('dtConnection.php');
		include_once("../../dominio/dSeguimiento.php");
		$con=new dtConnection();
		$conexion=$con->conect();
		$query="CALL obtenerSeguimientosDepartamento('$idDepartamento')";
		$resultado=mysqli_query($conexion,$query);
		$lista=array();

		while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
			$seguimiento=new dSeguimiento;
			$seguimiento->setId($row[0]);
			$seguimiento->setActividadTratamiento($row[1]);
			$seguimiento->setPorcentajeAvance($row[2]);
			$seguimiento->setComentarioAvance($row[3]);
			$seguimiento->setFechaAvance($row[4]);
			$seguimiento->setMontoSeguimiento($row[5]);
			$seguimiento->setEstadoSeguimiento($row[6]);
			array_push($lista, $seguimiento);
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		if(!$resultado){
			return false;
		}else{
			return $lista;
		}
	}

	function modificarSeguimientoAprobador($idSeguimiento,$seguimiento){
		include_once ("dtConnection.php");
		$con=new dtConnection();
		$conexion=$con->conect();
		$estadoSeguimiento=$seguimiento->getEstadoSeguimiento();
		$comentarioAprobador=$seguimiento->getComentarioAprobador();

        $conexion = $con->crearConexionPDO();
        try {
            $estadoSeguimiento=$seguimiento->getEstadoSeguimiento();
            $comentarioAprobador=$seguimiento->getComentarioAprobador();

            $mensajeMostrar = substr($comentarioAprobador, 0, 20);

            session_start();
            $creadorMensaje = $_SESSION['nombreUsuario'];
            $creadorMensaje.=" ".$_SESSION['apellidoUsuario'];
            $mensaje = "Han hecho un comentario a tu seguimiento: ".$mensajeMostrar;
            $url = "../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php";

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->beginTransaction();
            $conexion->exec("CALL actualizarSeguimientoAprobador('$idSeguimiento','$estadoSeguimiento','$comentarioAprobador')");           
            $conexion->exec("CALL insertarMensajeUsuarioSeguimiento('$creadorMensaje','$mensaje', '$url', '$idSeguimiento', '$id', '2')");

            $conexion->commit();
            return true;
        } catch (Exception $e) {
            $conexion->rollback();
            return false;
        }
	}

	function eliminarSeguimientoAprobador($idSeguimiento){
		include_once ("dtConnection.php");
		$con=new dtConnection();
		$conexion=$con->conect();
		$result = $conexion->query("CALL eliminarSeguimientoAprobador('$idSeguimiento')");
		if (!$result){
			return false;
		} else {
			return true;
		}
	}
	
}
?>