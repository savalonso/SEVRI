<?php
	session_start();
    $tipo="";
    if(isset($_SESSION['tipo'])){
        $tipo=$_SESSION['tipo'];
    }else{
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
?>
<script type="text/javascript" src="../js/jsTablas.js"></script>
<script type="text/javascript" src="../js/jsSevri.js"></script>
<script>
        window.onload=ocultarBarra();
</script>
<?php
    include("../../controladora/ctrListaSevri.php");
    $control = new ctrListaSevri();
    $lista = $control->obtenerListaSevri();
?>

<div class="row ">
                <h4>Crear Reportes</h4>
                <form id="IcrearSevri" method="Get" role="form" action="../controladora/ctrReportes.php" class="responsive">
                    <div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
                        <div>
                            <label class="white-text" for="sevriReporte">Seleccione el Sevri para realizar el reporte</label>
                            <select name="sevriReporte" id="sevriReporte">
                                <?php foreach ($lista as $sevri) { ?>
                                    
                                    <option value=<?php echo "\"".$sevri->getIdSevri()."\""; ?>><?php echo $sevri->getNombreVersion(); ?></option>

                                <?php } ?>
                            </select>
                        </div>

                        <input type="hidden" id="opcion" name="opcion" value="5">
                         
                        <div>
                            <input type="submit" value="Crear Reporte Excel" onclick="escogerTipoReporte(5)" class="btn btn-default">
                        </div><br>

                        <div>
                            <input type="submit" value="Crear Reporte Word" onclick="escogerTipoReporte(10)" class="btn btn-default">
                        </div><br>
                        
                    </div>
                </form>
            </div>
            <script>
                $(document).ready(function(){
                    $('.modal-trigger').leanModal();
                    $('.tooltipped').tooltip({delay: 50});
                    $('select').material_select();
                });

            </script>