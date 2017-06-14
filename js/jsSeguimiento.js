/**
 * Victor
 */
function modificarSeguimientoAsignado() {
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IModificarSeguimiento"));
    formData.append("opcion", 5);
    $.ajax({
        url : "../controladora/ctrSeguimiento.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
function eliminarSeguimiento(id) {
    document.getElementById('barraCargando').style.display="";
    var cedula = cedulaUsuario;
    var formData = new FormData();
    formData.append("opcion", 6);
    formData.append("id", id);
    $.ajax({
        url : "../controladora/ctrSeguimiento.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (data) {
        cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
function registrarSeguimiento(idAdministracion){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IRegistrarSeguimiento"));
    formData.append("opcion", 4);
    $.ajax({
        url : "../controladora/ctrSeguimiento.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ISeguimiento/IRealizarSeguimiento.php?IdAdministracion='+idAdministracion)
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}


function confirmarModificacionEliminacion(idSeguimiento){
    document.getElementById('idSeguimiento').value = idSeguimiento;
}

function eliminarSeguimientoAprobador(){
    document.getElementById('barraCargando').style.display="";
	var formData= new FormData();
	var idSeguimiento=document.getElementById('idSeguimiento').value;
	formData.append("idSeguimiento", idSeguimiento);
	formData.append("opcion",3);
	$.ajax({
		url:"../controladora/ctrSeguimiento.php",
		type: "post",
        dataType: "html",
        data:formData,
        cache:false,
        contentType:false,
        processData:false
	}).done(function(data){
		cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php');
		Materialize.toast(data, 7000, 'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
	});
}

function modificarSeguimiento(){
    document.getElementById('barraCargando').style.display="";
	var formData=new FormData(document.getElementById("modificarSeguimiento"));
	formData.append("opcion",2);
	$.ajax({
        url:"../controladora/ctrSeguimiento.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
   }).done(function(data) {
        cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });

}
function insertarSeguimiento(){
    document.getElementById('barraCargando').style.display="";
	var formData=new FormData(document.getElementById("insertarSeguimientoAprobador"));
	formData.append("opcion",1);
	$.ajax({
        url:"../controladora/ctrSeguimiento.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
   }).done(function(data) {
        cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
function cargarFormulario(){
    var estadoSelect=document.getElementById("estado").value;
    if(estadoSelect==1){
        document.getElementById("temporalSeguimiento").style.display = 'none';   
    }else if(estadoSelect==0){     
         document.getElementById("temporalSeguimiento").style.display = 'block';
    }
}
function cargarFormularioModificar(){
    var estadoSelect=document.getElementById("estadoSeguimiento").value;
    if(estadoSelect==0){
        document.getElementById("temporalComentario").style.display = 'block';   
    }else if(estadoSelect==1 ){     
         document.getElementById("temporalComentario").style.display = 'none';
    }   
}