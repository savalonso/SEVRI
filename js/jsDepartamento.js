
function insertarDepartamento(){
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
    }); 
}

function modificarDepartamento(){
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
    });
}

function eliminarDepartamento(){
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

    });
}

function confirmarEliminarDepartamento(idDepartamento){
    document.getElementById('idDepartamento').value = idDepartamento;
}

function ocultarDivModificar(){
    document.getElementById('divModificarDepartamentos').style.display='none';
}

function invocarDivModificarDepartamento(button,idDepartamento){
    var row=button.parentNode.parentNode;
    var cells= row.querySelectorAll('td:not(:last-of-type)');
    document.getElementById('codigoDepartamento').value=cells[0].innerText;
    document.getElementById('codigoDepartamento').placeholder = "dato: " + cells[0].innerText; 
    document.getElementById('nombreDepartamento').value=cells[1].innerText;
    document.getElementById('nombreDepartamento').placeholder = "dato: " + cells[1].innerText;
    document.getElementById('fechaDepartamento').value=cells[2].innerText;
    document.getElementById('fechaDepartamento').placeholder = "dato: " + cells[2].innerText;
    document.getElementById('idDepartamento').value = idDepartamento;
    document.getElementById('divModificarDepartamentos').style.display = '';
    $( document ).ready(function(){
    $('select').material_select();
    });
}

function agregarUsuarioDepartamento(idDepartamento, cedulaUsuario){
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
    });
}

function eliminarUsuarioDepartamento(idDepartamento, cedulaUsuario){
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
    }); 
}