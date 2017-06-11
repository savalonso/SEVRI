function insertarUsuarios(){
    document.getElementById('btn_Guardar').disabled = true;
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IRegistrarUsuarios"));
    formData.append("opcion", 1);
    $.ajax({
        url : "../controladora/ctrUsuarios.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}

function modificarUsuarios() {
    document.getElementById('btnModificarUsuario').disabled = true;
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById('IModificarUsuarios'));
    formData.append("opcion", 2);
    $.ajax({
        url: "../controladora/ctrUsuarios.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (data) {
        cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php');
        Materialize.toast(data, 7000, 'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}

function eliminarUsuario(cedulaUsuario) {
    document.getElementById('btnEliminarUsuario').disabled = true;
    document.getElementById('barraCargando').style.display="";
    var cedula = cedulaUsuario;
    var formData = new FormData();
    formData.append("opcion", 3);
    formData.append("cedula", cedula);
    $.ajax({
        url: "../controladora/ctrUsuarios.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (data) {
        cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php');
        Materialize.toast(data, 7000, 'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}

function dirigir_url_mensaje(url, idMensaje) {
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData();
    formData.append("opcion", 5);
    formData.append("idMensaje", idMensaje);
    $.ajax({
        url: "../controladora/ctrUsuarios.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (data) {
        document.getElementById('barraCargando').style.display="none";
        $('#contenedor').load(url);
    });
}

function traerMensajesNuevos(){
    cedulaUsuario = document.getElementById('cedulaOculta').value;
    var formData = new FormData();
    formData.append("opcion", 4);
    formData.append("cedula", cedulaUsuario);
    $.ajax({
        url: "../controladora/ctrUsuarios.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (data) {
        document.getElementById('cantMenUsuario').innerHTML = "Mensajes: " + data;
        document.getElementById('cantMenUsuario2').innerHTML = "Mensajes: " + data;
    });
}

function limpiar(){
    document.getElementById('usuario').value="";
    document.getElementById('clave').value="";
}
/*aqui se encuentra el paginador de las tablas*/
 
 
 $(document).ready(function(){
        $("#tbUsuario").paginationTdA({
            elemPerPage: 4
        });
    });

/*aqui finalisa*/

/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#datosUsuario').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#datosU tr').hide();
            $('#datosU tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));
});
/*fin filtrado*/