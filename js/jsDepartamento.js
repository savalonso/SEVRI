
function insertarDepartamento(){
    document.getElementById('barraCargando').style.display="";
    var formData= new FormData(document.getElementById("ingresarDepartamento"));
    formData.append("opcion",1);
    $.ajax({
    url:"../controladora/ctrDepartamentos.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IDepartamento/IMostrarDepartamentos.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}

function modificarDepartamento(){
    document.getElementById('barraCargando').style.display="";
    var formData=new FormData(document.getElementById("modificarDepartamento"));
    formData.append("opcion", 2);
    $.ajax({
        url:"../controladora/ctrDepartamentos.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
   }).done(function(data) {
        cargarPagina('../interfaz/IDepartamento/IMostrarDepartamentos.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}

function eliminarDepartamento(){
    document.getElementById('barraCargando').style.display="";
    var formData=new FormData();
    var idDepartamento=document.getElementById('idDepartamento').value;
    formData.append("idDepartamento",idDepartamento);
    formData.append("opcion",3);
    $.ajax({
        url:"../controladora/ctrDepartamentos.php",
        type: "post",
        dataType: "html",
        data:formData,
        cache:false,
        contentType:false,
        processData:false
    }).done(function(data){
        cargarPagina('../interfaz/IDepartamento/IMostrarDepartamentos.php');
        Materialize.toast(data, 7000, 'blue darken-3');
        document.getElementById('barraCargando').style.display="none";

    });
}

function confirmarEliminarDepartamento(idDepartamento){
    document.getElementById('idDepartamento').value = idDepartamento;
}

function agregarUsuarioDepartamento(idDepartamento, cedulaUsuario){
    document.getElementById('barraCargando').style.display="";
    var formData= new FormData();
    formData.append("opcion",4);
    formData.append("idDepartamento",idDepartamento);
    formData.append("cedulaUsuario",cedulaUsuario);
    $.ajax({
    url:"../controladora/ctrDepartamentos.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}

function eliminarUsuarioDepartamento(idDepartamento, cedulaUsuario){
    document.getElementById('barraCargando').style.display="";
    var formData= new FormData();
    formData.append("opcion",5);
    formData.append("idDepartamento",idDepartamento);
    formData.append("cedulaUsuario",cedulaUsuario);
    $.ajax({
    url:"../controladora/ctrDepartamentos.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}

/*paginacion*/
$(document).ready(function(){
        $("#mostrarDep").paginationTdA({
            elemPerPage: 4
        });
    });

/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#datosDepartamento').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#datosD tr').hide();
            $('#datosD tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));
});
/*fin filtrado*/