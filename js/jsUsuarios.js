function insertarUsuarios(){
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
    });
}

function modificarUsuarios() {
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
    });
}

function eliminarUsuario(cedulaUsuario) {
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
    });
}

function irPaginaEnlace(url, idMensaje){
    formData.append("opcion", 3);
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
    });
}