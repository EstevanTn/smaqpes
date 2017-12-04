var cliente = {
    InitGridClientes: function(){
        $('#tb-cliente').DataTable({
            ajax: {
                type: 'POST',
                url: urlListarClientes,
                error: function (response) {
                    console.dir(response);
                }
            },
            columns: [
                {'data': 'ruc', sWidth: '15%'},
                {'data': 'razon_social', sWidth: '35%'},
                {'data': function(row){ return row.nombres+" "+row.apellidos;}, sWidth: '40%'},
                {'data': function(row){
                    return "<input type='radio' data-info='"+JSON.stringify(row)+"' data-role='selected-cliente' />";
                },sWidth: '10%', sClass: 'text-center'},
            ],
            drawCallback: function (settings) {
                $("input[data-role='selected-cliente']").iCheck({
                    cursor: true,
                    increaseArea: '20%',
                    radioClass: 'iradio_flat',
                    checkboxClass: 'iradio_flat',
                });
            }
        });
    },
    InitGridMaquinaria: function () {
        $("#tb-maquinaria").DataTable({
            ajax: {
                url: urlListarMaquinarias,
                type: 'POST'
            },
            columns: [
                { data: 'nombre', sWidth: '25%'},
                { data: 'marca', sWidth: '15%'},
                { data: 'modelo', sWidth: '15%'},
                { data: 'serie_chasis', sWidth: '13%'},
                { data: 'serie_motor', sWidth: '12%'},
                { data: function(row){
                    return "<input type='radio' data-role='selected-maquinaria' data-info='"+JSON.stringify(row)+"' />";
                }, sWidth: '10%', sClass: 'text-center'},
            ],
            drawCallback: function (options) {
                $('input[data-role="selected-maquinaria"]').iCheck({
                   radioClass: 'iradio_flat',
                    cursor: true,
                });
            }
        });
    },
    InitGridPersonal: function () {
        $("#tb-personal").DataTable({
            ajax: {
                url: urlListarPersonal,
                type: 'POST'
            },
            columns: [
                { data: function (row) {
                    return row.nombres+" "+row.apellidos;
                }, sWidth: '40%'},
                {data:'area', sWidth: '15%'},
                {data:'cargo', sWidth: '15%'},
                {data: function (row) {
                    return "<input type='radio' data-role='selected-personal' data-info='"+JSON.stringify(row)+"' />";
                }, sWidth: '15%', sClass: 'text-center'},
            ],
            drawCallback: function (settings) {
                $('input[data-role="selected-personal"]').iCheck({
                    radioClass: 'iradio_flat',
                    cursor: true,
                });
            }
        });
    },
    buttonCliente: function (buttonElement) {
        var selected = $('input[data-role="selected-cliente"]:checked').data('info');
        if(selected){
            $('#modal-cliente').modal('hide');
            $('#id_cliente').val(selected.id_cliente);
            $('#nombre_cliente').val(selected.nombres+" "+selected.apellidos);
        }else{
            BootstrapDialog.alert('Seleccione un cliente!');
        }
    },
    buttonPersonal: function (buttonElement) {
        var target = $(buttonElement).data('target');
        $('button[role="submit"]', target).off('click').on('click', function () {
            var selected = $('input[data-role="selected-personal"]:checked').data('info');
            var tipo = $(buttonElement).data('role');
            if(selected){
                $('#modal-personal').modal('hide');
                $('#id_'+tipo).val(selected.id_personal);
                $('#nombre_'+tipo).val(selected.nombres+" "+selected.apellidos);
                $('input[data-role="selected-personal"]').iCheck('uncheck');
            }else{
                BootstrapDialog.alert('Seleccione personal!');
            }
        });
    },
    buttonMaquinaria: function (buttonElement) {
        var selected = $('input[data-role="selected-maquinaria"]:checked').data('info');
        if(selected){
            $('#modal-maquinaria').modal('hide');
            $('#id_maquinaria').val(selected.id_maquinaria);
            $('#nombre_maquinaria').val(selected.nombre);
        }else{
            BootstrapDialog.alert('Seleccione una maquinaria!');
        }
    }
};
$(document).ready(function(){
    cliente.InitGridClientes();
    cliente.InitGridMaquinaria();
    cliente.InitGridPersonal();
    $('button[role="submit"]', '#modal-cliente').on('click', function (e) {
        cliente.buttonCliente(this);
    });
    $('button[role="submit"]', '#modal-maquinaria').on('click', function (e) {
        cliente.buttonMaquinaria(this);
    });
});
