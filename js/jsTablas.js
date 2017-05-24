$(document).ready(function () {
    (function ($) {

        $('#filtrarTabla').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('.buscar tr').hide();
            $('.buscar tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

      (function ($) {

        $('#filtrarTabla2').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('.buscar2 tr').hide();
            $('.buscar2 tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});

