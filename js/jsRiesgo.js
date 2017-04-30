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

    var formData = new FormData(document.getElementById("IIdentificarRiesgo")); 
    
    formData.append("opcion", 1);

    var cate = document.getElementById("subcategoria").value;

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
    });
}
function modificarRiesgoConsulta(id){  
    var formData = new FormData(document.getElementById("IListaModificarRiesgo"));
    formData.append("idRiesgo", id);
    $.ajax({
        url : "../interfaz/IRiesgo/IModificarRiesgo.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
    });
}
function eliminarRiesgo(){
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
    });
}
function modificarRiesgo(){
    var formData = new FormData(document.getElementById("IModificarRiesgo")); 
    var id = document.getElementById("idRiesgo").value;
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
