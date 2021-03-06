function nuevoAjax(){
    var xmlhttp = false;
    try{
        //par que sirva en cualquier browser que no sea Internet Explorew
        xmlhttp= ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            //para sirva en internet explorex
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){
            xmlhttp= false;
        }
    }
    if(!xmlhttp && typeof XMLHttpRequest != 'undefined' ){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}


function insertarRiesgo(){
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    document.getElementById('btnInsertarRiesgo').disabled = true;

    var formData = new FormData(document.getElementById("IIdentificarRiesgo")); 
    
    formData.append("opcion", 1);

    var cate = document.getElementById("subcategoria").value;

    var monto = document.getElementById('monto').value;
    if (monto.length == 0 || monto.length == 1) {
        formData.append("montoE",0);
    }else{
        formData.append("montoE",monto);
    }

    var IdDepartamento=document.getElementById("departamentoUsuario").value;

    formData.append("idDepartamento",IdDepartamento);
    

    if(cate!=0){
        formData.append("sub", cate);
    }else{
        cate = document.getElementById("categoria").value;
        formData.append("sub", cate);
    }
    $.ajax({
        url : "../controladora/ctrRiesgo.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IRiesgo/IMostrarRiesgosDepartamento.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}


function eliminarRiesgo(){
    desabilitarBotonesModEli();
    document.getElementById('btnEliminarRiesgo').disabled = true;
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IIdentificarRiesgo"));
    var id = document.getElementById("idRiesgo").value;
    formData.append("opcion", 3);
    formData.append("idRiesgo", id);
    $.ajax({
        url : "../controladora/ctrRiesgo.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IRiesgo/IMostrarRiesgosDepartamento.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}

function generarReporte(url){
    alert(url);
    $().load(url);
}

function modificarRiesgo(){
    desabilitarBotonesModEli();
    document.getElementById('btnModificarRiesgo').disabled = true;
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IModificarRiesgo")); 
    var id = document.getElementById("idRiesgo").value;

    var cate = document.getElementById("subcategoria").value;
    if(cate!=0){
        formData.append("sub", cate);
    }else{
        cate = document.getElementById("categoria").value;
        formData.append("sub", cate);
    }

    var monto = document.getElementById('monto').value;
    if (monto.length == 0 || monto.length == 1) {
        formData.append("montoE",0);
    }else{
        formData.append("montoE",monto);
    }

    formData.append("idRiesgo", id);
    formData.append("opcion", 4);
    $.ajax({
        url : "../controladora/ctrRiesgo.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IRiesgo/IMostrarRiesgosDepartamento.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
function confirmarModificacionEliminacion(idRiesgo){
    document.getElementById('idRiesgo').value = idRiesgo;
}


function cancelarModificar(){
    document.getElementById('contenedorConfirmacion').style.display = 'none';
}

function cargarGUIMostrarRiesgos(){

    var idDepartamento=document.getElementById("departamentos").value;

    if(idDepartamento!=0){

        $('#mostrarRiesgos').load("../interfaz/IRiesgo/IMostrarRiesgo.php?id="+idDepartamento);
        
    }


}

function format(input){
        var num = input.value.replace(/\./g,'');
        input.value = num;
        num = input.value.replace(/\₡/g,'');
        if(!isNaN(num)){
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/,'');
            num = num.replace(/\./g,'.');
            input.value ='₡'+num;
        }else{ 
            input.value = input.value.replace(/[^\d\.]*/g,'');
        }
    }

function cargarGUIMostrarRiesgosAnalisis(){

    var idDepartamento=document.getElementById("departamentos").value;

    if(idDepartamento!=0){

        $('#mostrarRiesgosAnalisis').load("../interfaz/IAnalisis/IAnalizarRiesgo.php?id="+idDepartamento);
        
    }


}

function cargarGUIMostrarRiesgosAdministracion(){

    var idDepartamento=document.getElementById("departamentos").value;


    if(idDepartamento!=0){

        $('#mostrarRiesgosAdministracion').load("../interfaz/IAdministracion/ISeleccionarRiesgoAdministracion.php?id="+idDepartamento);
        
    }
    
}

function cargarGUIMostrarRiesgosAnalizados(){

    var idDepartamento=document.getElementById("departamentos").value;
   
    if(idDepartamento!=0){

        $('#mostrarRiesgosAnalizados').load("../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php?id="+idDepartamento);
        
    }

}

$(document).ready(function(){
        $("#MostrarRiesgos").paginationTdA({
            elemPerPage: 4
        });
    });

/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#datosRiesgos').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#datosR tr').hide();
            $('#datosR tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));
});
/*fin filtrado*/

