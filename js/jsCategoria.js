function insertarCategoria(){
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IInsertarCategoria"));
    if(document.getElementById('categoria').disabled==false){
      formData.append("subcategoria", 1);
    }else{
      formData.append("subcategoria", 0);
    }
    formData.append("opcion", 1);
    $.ajax({
    url : "../controladora/ctrCategoria.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });    
}
function confirmarModificacionEliminacionCategoria(idCategoria){
    document.getElementById('idCategoria').value = idCategoria;
}

function cancelarModificar(){
    document.getElementById('contenedorConfirmacion').style.display = 'none';
}
function eliminarCategoria(){
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IMostrarCategoria"));
    var id = document.getElementById("idCategoria").value;
    formData.append("opcion", 2);
    formData.append("idCategoria", id);
    $.ajax({
        url : "../controladora/ctrCategoria.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
function modificarCategoria(){
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IModificarCategoria")); 
    var id = document.getElementById("id").value;
    formData.append("idCategoria", id);
    if(document.getElementById('categoria').disabled==false){
      formData.append("subcategoria", 1);
    }else{
      formData.append("subcategoria", 0);
    }
    formData.append("opcion", 3);
    $.ajax({
        url : "../controladora/ctrCategoria.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
/*aqui se encuentra el paginador de las tablas*/
 $(document).ready(function(){

        $("#tbCategorias").paginationTdA({
            elemPerPage: 4
        });
    });
 $(document).ready(function(){
        $("#tbCategoriasAgregadas").paginationTdA({
            elemPerPage: 4
        });
    });
 $(document).ready(function(){
        $("#categoria").paginationTdA({
            elemPerPage: 4
        });
    });
 $(document).ready(function(){

        $("#subCategorias").paginationTdA({
            elemPerPage: 4
        });
    });

/*aqui finalisa*/
/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#datosCategoria').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#categoria1 tr').hide();
            $('#categoria1 tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));
      (function ($) {

        $('#datosSubCategoria').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('.subcategoria tr').hide();
            $('.subcategoria tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
/*funcion que levanta el modal*/

    $(document).ready(function(){
        $('.modal-trigger').leanModal();
    });

function validarInsertarCategoria(){
    if(document.getElementById('categoria').disabled==false){
        $("#IInsertarCategoria").validate({
            rules: {
                nombre: { required: true,minlength: 5, maxlength: 100},
                descripcion: { required:true,minlength: 20, maxlength: 2000},
                tipo: {required : true},
            },
            messages: {
                nombre: "Debe introducir un nombre de categor&iacutea mayor de 5 car&aacutecteres.",
                descripcion: "Debe introducir una descripci&oacuten de categor&iacutea mayor de 20 car&aacutecteres.",
                tipo: "Debe seleccionar un tipo.",
            },
            submitHandler: function(form){
                if(document.getElementById('categoria').value==0){
                    Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
                }else{
                    insertarCategoria(); 
                }
            }
        });
    }else{
        $("#IInsertarCategoria").validate({
            rules: {
                nombre: { required: true,minlength: 5, maxlength: 100},
                descripcion: { required:true,minlength: 20, maxlength: 2000},
                tipo: {required : true},
                categoria: {required: true},
            },
            messages: {
                nombre: "Debe introducir un nombre de categor&iacutea mayor de 5 car&aacutecteres.",
                descripcion: "Debe introducir una descripci&oacuten de categor&iacutea mayor de 20 car&aacutecteres.",
                tipo: "Debe seleccionar un tipo.",
                categoria: "Debe seleccionar una sub categor&iacutea.",
            },
            submitHandler: function(form){
                if(document.getElementById('categoria').value==0 && document.getElementById('categoria').disabled==false){
                    Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
                }else{
                    insertarCategoria();
                }
            }
        });
    }
}
function validarModificarCategoria(){
    if(document.getElementById('categoria').disabled==false){
        $("#IModificarCategoria").validate({
            rules: {
                nombre: { required: true,minlength: 5, maxlength: 100},
                descripcion: { required:true,minlength: 20, maxlength: 2000},
                tipo: {required : true},
            },
            messages: {
                nombre: "Debe introducir un nombre de categor&iacutea mayor de 5 car&aacutecteres.",
                descripcion: "Debe introducir una descripci&oacuten de categor&iacutea mayor de 20 car&aacutecteres.",
                tipo: "Debe seleccionar un tipo.",
            },
            submitHandler: function(form){
                if(document.getElementById('categoria').value==0){
                    Materialize.toast("Debe de seleccionar una categor&iacutea v&aacutelida", 7000,'blue darken-3');
                }else{
                    modificarCategoria();
                }
            }
        });
    }else{
        $("#IModificarCategoria").validate({
            rules: {
                nombre: { required: true,minlength: 5, maxlength: 100},
                descripcion: { required:true,minlength: 20, maxlength: 2000},
                tipo: {required : true},
                categoria: {required: true},
            },
            messages: {
                nombre: "Debe introducir un nombre de categor&iacutea mayor de 5 car&aacutecteres.",
                descripcion: "Debe introducir una descripci&oacuten de categor&iacutea mayor de 20 car&aacutecteres.",
                tipo: "Debe seleccionar un tipo.",
                categoria: "Debe seleccionar una sub categor&iacutea.",
            },
            submitHandler: function(form){
                modificarCategoria();
            }
        });
    }
}

