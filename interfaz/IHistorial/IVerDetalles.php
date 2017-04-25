<!DOCTYPE html>
	<?php
		session_start();

		$idRiesgo = $_GET['idRiesgo'];
		include ("../../data/dtRiesgo.php");
		$controlR = new dtRiesgo;
		$listaR = $controlR->obtenerRiesgoDetalles($idRiesgo);
		foreach ($listaR as $riesgo) {
			$id = $riesgo->getId();
			$idDepartamento = $riesgo->getIdDepartamento();
			$nombre = $riesgo->getNombre();
			$descripcion = $riesgo->getDescripcion();
			$monto = $riesgo->getMontoEconomico();
			$causa = $riesgo->getCausa();
			$subcategoria = $riesgo->getIdCategoria();
			$estado = $riesgo->getEstaActivo();
		}
		include ("../../data/dtAnalisis.php");
		$controlA = new dtAnalisis;
		$listaA = $controlA->obtenerAnalisisPorRiesgo($idRiesgo);
		foreach ($listaA as $analisis) {
			$probabilidad = $analisis->getProbabilidad();
			$impacto = $analisis->getImpacto();
			$nivel = $analisis->getNivelRiesgo();
			$medida = $analisis->getMedidaControl();
			$calificacion = $analisis->getCalificacionMedida();
		}
	?>
	<script>
		window.onload=ocultarBarra();
	</script>	
	<h2>Detalles del riesgo.</h2>		
	<div class="row">
		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<h5>Nombre:</h5>
			<p><?php echo "$nombre"; ?></p><hr>
			<h5>Descripci&oacuten:</h5>
			<p><?php echo "$descripcion"; ?></p><hr>
			<h5>Estado:</h5>
			<p><?php if($monto==0){echo"Inactivo";}else{echo"Activo";} ?></p><hr>
			<h5>Monto:</h5>
			<p><?php echo "₡".number_format($monto, 2, ',', ' '); ?></p><hr>
			<h5>Catagor&iacutea:</h5>
			<p><?php echo "$subcategoria"; ?></p><hr>
			<h5>Causa:</h5>
			<p><?php echo "$causa"; ?></p><hr>
		</div>
		<div class="col s6 m6 l6 blue darken-3 z-depth-5">
			<?php 
				if(isset($probabilidad)){
					?>
						<h5>Probalididad:</h5>
						<p><?php echo "$probabilidad"; ?></p><hr>
						<h5>Impacto:</h5>
						<p><?php echo "$impacto"; ?></p><hr>
						<h5>Nivel:</h5>
						<p><?php echo"$nivel"; ?></p><hr>
						<h5>Medida de control:</h5>
						<p><?php echo "$medida"; ?></p><hr>
						<h5>Calificaci&nacuten medida:</h5>
						<p><?php echo "$calificacion"; ?></p><hr>
					<?php
				}else{
					?>
						<h5>Este riesgo no tiene un an&aacute;lisis registrado.</h5>
					<?php
				}
			 ?>
		</div>
	</div>
</!DOCTYPE html>