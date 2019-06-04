
$(function () {
    
    $("#UsersTable").dataTable({
        "oLanguage": {
            "sLengthMenu": "_MENU_ registros por pagina",
            "sZeroRecords": "No funciona - Lo sentimos!",
            "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
            "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
            "sSearch": "Buscar:"
         }  
    });

    $(".modalesDir").click(function(){
        $("#idDireccion").val($(this).attr('iddir'));
        $("#editarDireccion").val($(this).attr('nombre'));
    }); 
    $(".modalesPais").click(function(){
        $("#idPais").val($(this).attr('idpa'));
        $("#editarPais").val($(this).attr('nombre'));
    });
    $(".modalesDpto").click(function(){
        $("#iddptos").val($(this).attr('iddpto'));
        $("#editarDpto").val($(this).attr('nombre'));
    });
    $(".modalesCiu").click(function(){
        $("#idciudades").val($(this).attr('idciu'));
        $("#editarCiudad").val($(this).attr('nombre'));
    });
    $(".modalesRol").click(function(){
        $("#idRoles").val($(this).attr('idrol'));
        $("#editarRoles").val($(this).attr('nombre'));
    });
    
    
});