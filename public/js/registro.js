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
                    return "<input name='selected-cliente' type='radio' data-info='"+JSON.stringify(row)+"' data-role='selected-cliente' />";
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
                    return "<input name='selected-maquinaria' type='radio' data-role='selected-maquinaria' data-info='"+JSON.stringify(row)+"' />";
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
            if(selected.id_tipo_documento!==7){
                $('#kilometraje').attr('readonly', 'readonly');
            }else{
                $('#kilometraje').removeAttr('readonly');
            }
            cliente.getHorasMantenimiento(selected.id_maquinaria);
        }else{
            BootstrapDialog.alert('Seleccione una maquinaria!');
        }
    },
    getHorasMantenimiento: function (id_maquinaria) {
        var list = $('#list_horas_mantenimiento');
        list.empty();
        $.ajax({
           url: urlListarHorasMantenimiento,
            type: 'POST',
            data: { id_maquinaria: id_maquinaria },
            success: function (response) {
                $.each(response.data, function (i, e) {
                    var option = $('<option>',{
                        text: this.total_horas,
                        'data-value': this.id_horas_mantenimiento,
                    });
                    list.append(option);
                });
                $('#total_horas').off('input').on('input', function(e){
                    var text = $(this).val();
                    $('#list_horas_mantenimiento option').each(function (i, e) {
                        if($(this).text()===text){
                            var id = $(this).data('value');
                            $('#id_total_horas').val(id);
                        }
                    });
                    if(text.trim()===''){
                        $('#id_total_horas').val(0);
                    }
                });
            }
        });
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
    $('#btn-detalle-mantenimiento').on('click', function () {
        $('#modal-detalle-mantenimiento').modal('show');
        $.ajax({
           url: urlListarDetalleHorasMantenimiento,
            type: 'POST',
            data:{ id_horas: $('#id_total_horas').val() },
            success: function (response) {
               console.log(response);
                $('#tb-detalle-mantenimiento').DataTable({
                    data: response.data,
                    destroy: true,
                    columns: [
                        { data: 'descripcion', sWidth: '36%' },
                        { data: 'tipo_material', sWidth: '15%' },
                        { data: function (row, type, set, meta) {
                            if(row.cantidad){
                                return row.cantidad;
                            }
                            return '-';
                        }, sWidth: '10%', sClass: 'text-right' },
                        { data: function (row, type, set, meta) {
                            if(row.litros){
                                return row.litros;
                            }
                            return '-';
                        }, sWidth: '7%', sClass: 'text-right' },
                        { data: function (row, type, set, meta) {
                            if(row.galones){
                                return row.galones;
                            }
                            return '-';
                        }, sWidth: '7%', sClass: 'text-right' },
                        { data: 'nombre_proveedor', sWidth: '15%' },
                        { data: 'precio_proveedor', sWidth: '10%', sClass:'text-right' },
                    ]
                });
            }
        });
    });
});
