<?php
    session_start();
    $tipo="";
    if(isset($_SESSION['tipo'])){
        $tipo=$_SESSION['tipo'];
    }else{
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
    if($tipo!='Administrador'){
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
?>
<script>
	window.onload=ocultarBarra();
</script>
<?php 
include_once ("../../controladora/ctrListaUsuario.php");
include_once("../../controladora/ctrListaDepartamento.php");
include_once("../../controladora/ctrListaDepartamentoUsuario.php");
$idDepartamento = $_GET['idDepartamento'];
$controlDepartamento = new ctrListaDepartamento;
$controlUsuarios = new ctrListaUsuario;
$controlDepaUsu = new ctrListaDepartamentoUsuario;
$listaDepartamento = $controlDepartamento->obtenerDepartamento($idDepartamento);
$listaUsuarios = $controlUsuarios->obtenerListaUsuarios();
$listaDepaUsu = $controlDepaUsu->obtenerDepartamentoUsuario($idDepartamento);
foreach ($listaDepartamento as $departamento) {
    echo "<h4>Agregar usuarios al departamento de ".$departamento->getNombreDepartamento()."</h4>";
}

?>

<h4>Lista de usuarios no registrados</h4>
<div class="row" id="usuarios1">
    <div class="">
    
    <?php
    if($listaUsuarios!=null) {
        if($listaDepaUsu != null) {
    ?>
    <table class="responsive-table striped centered responsive2">
        <thead>
            <tr>
                <th>Agregar</th>
                <th>C&eacutedula</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listaUsuarios as $usuario){
                $encontro = false;
                foreach($listaDepaUsu as $du){
                    if($du->getCedulaUsuario() == $usuario->getCedula()){
                        $encontro = true;
                    }
                }
                if(!$encontro){
                echo "<tr><td><input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"agregarUsuarioDepartamento(".$idDepartamento.",'".$usuario->getCedula()."'), cargarPagina('../interfaz/IDepartamento/IAgregarUsuarioDepartamento.php?idDepartamento=".$idDepartamento."')\"></td><td>".$usuario->getCedula()."</td><td>".$usuario->getPrimerApellido()."</td><td>".$usuario->getSegundoApellido()."</td><td>".$usuario->getNombre()."</td><td>".$usuario->getCargo()."</td><td>".$usuario->getTipo()."</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <?php
        } else {
    ?>
    <table class="responsive-table striped centered responsive2">
        <thead>
            <tr>
                <th>Agregar</th>
                <th>C&eacutedula</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listaUsuarios as $usuario){
                echo "<tr><td><input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"agregarUsuarioDepartamento(".$idDepartamento.",'".$usuario->getCedula()."'), cargarPagina('../interfaz/IDepartamento/IAgregarUsuarioDepartamento.php?idDepartamento=".$idDepartamento."')\"></td><td>".$usuario->getCedula()."</td><td>".$usuario->getPrimerApellido()."</td><td>".$usuario->getSegundoApellido()."</td><td>".$usuario->getNombre()."</td><td>".$usuario->getCargo()."</td><td>".$usuario->getTipo()."</td></tr>";}
            ?>
        </tbody>
        </table>
        <?php
        }
    } else{
        echo "<h5>No hay usuarios registrados</h5>";
    }
        ?>
    </div>
</div>
<h4>Lista de usuarios registrados</h4>
<div class="row" id="usuarios2">
    <div class="">
    
    <?php  
    if($listaUsuarios!=null) {
        if($listaDepaUsu != null) {
    ?>
        <table class="responsive-table striped centered responsive2">
            <thead>
                <tr>
                    <th>Agregar</th>
                    <th>C&eacutedula</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($listaUsuarios as $usuario){
                foreach($listaDepaUsu as $du){
                    if($du->getCedulaUsuario() == $usuario->getCedula()){
                        echo "<tr><td><input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"eliminarUsuarioDepartamento(".$idDepartamento.",'".$usuario->getCedula()."'), cargarPagina('../interfaz/IDepartamento/IAgregarUsuarioDepartamento.php?idDepartamento=".$idDepartamento."')\"></td><td>".$usuario->getCedula()."</td><td>".$usuario->getPrimerApellido()."</td><td>".$usuario->getSegundoApellido()."</td><td>".$usuario->getNombre()."</td><td>".$usuario->getCargo()."</td><td>".$usuario->getTipo()."</td></tr>";
                    }
                }
            }
            ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<h4>No hay usuarios registrados</h4>";
        }
    }
        ?>
    </div>
</div>