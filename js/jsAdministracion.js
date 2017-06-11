function insertarAdministracion(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IAdministrarRiesgo")); 
    formData.append("opcion", 1);
    $.ajax({
    url : "../controladora/ctrAdministracion.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IAdministracion/IMostrarRiesgosAdministracion.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}
function invocarDivModificarAdmi(button,idAdministracion){
    var row = button.parentNode.parentNode;
    var cells = row.querySelectorAll('td:not(:last-of-type)');

    document.getElementById('actividad').value = cells[1].innerText;
    document.getElementById('actividad').placeholder = "dato: " + cells[1].innerText;

    document.getElementById('indicador').value = cells[2].innerText;
    document.getElementById('indicador').placeholder = "dato: " + cells[2].innerText;

    document.getElementById('valor').value = "₡" + cells[4].innerText;
    document.getElementById('valor').placeholder = "dato: ₡" + cells[4].innerText;

    document.getElementById('plazo').value = cells[3].innerText;
    document.getElementById('plazo').placeholder = "dato: " + cells[3].innerText;

    document.getElementById('encargado').value = cells[5].innerText;
    document.getElementById('encargado').placeholder = "dato: " + cells[5].innerText;

    var medida = cells[0].innerText;
    var responsable = cells[5].innerText;

    document.getElementById('idAdmi').value = idAdministracion;

    encontrarSeleccionado('medida', medida);
    encontrarSeleccionado('encargado', responsable);
    $( document ).ready(function(){
        $('select').material_select();
    });
    document.getElementById('divModificarAdministracion').style.display = '';
}
function encontrarSeleccionado(idSelect, valor){
    var select = document.getElementById(idSelect);
    for (var i = select.length - 1; i >= 0; i--) {
        if(select[i].innerText  == valor){
            select[i].selected = true;
        }
    }
}
function ocultarDivActualizar(){
    document.getElementById('divModificarAdministracion').style.display = 'none';
}
function modificarAdministracion(){
    document.getElementById('barraCargando').style.display="";
  
    var formData = new FormData(document.getElementById("IModificarAdministrarRiesgo")); 
    formData.append("opcion", 2);
    $.ajax({
    url : "../controladora/ctrAdministracion.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IAdministracion/IMostrarRiesgosAdministracion.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}
function confirmarEliminarAdministracion(idAdministracion){
    document.getElementById('idAdministracion').value = idAdministracion;
}
function eliminarAdministracion(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData();
    var idAdmi = document.getElementById('idAdministracion').value;
    formData.append("idAdmi", idAdmi); 
    formData.append("opcion", 3);
    $.ajax({
    url : "../controladora/ctrAdministracion.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IAdministracion/IMostrarRiesgosAdministracion.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}
function mascaraDinero(input){
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