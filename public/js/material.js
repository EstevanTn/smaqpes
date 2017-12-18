var material = {
    setDefaultOption: function (target) {
        $(target).empty();
        $(target).append($('<option>',{
            text: '-- SELECCIONE --',
            value: 0
        }));
    },
    setOptions: function (values, target) {
        this.setDefaultOption(target);
        $.each(values, function (i) {
            var option = $('<option>', values[i]);
            option.data('entity',values[i]);
            $(target).append(option);
        });
    },
    getAllMateriales: function (id_tipo_material, params) {
        var self = this;
        $.ajax({
            url: urlListarMateriales,
            data: {
                id_tipo_material: id_tipo_material,
                tipo: 'tipo_material'
            },
            success: function (response) {
                self.setOptions($.map(response, function (e,i) {
                    return {
                        text: e.nombre,
                        value: e.id_material,
                    };
                }), '#id_material');
                if($.isPlainObject(params) && typeof (params.params.fnCallback)==='function'){
                    console.info('Se han listado los materiales');
                    params.params.fnCallback(params);
                }
            }
        });
    },
    getAllProveedoress: function (id_material, params) {
        var self = this;
        $.ajax({
            url: urlListarMateriales,
            data: {
                tipo: 'material_proveedor',
                id_material: id_material
            },
            success: function (response) {
                self.setOptions($.map(response, function (e,i) {
                    return {
                        text: e.nombre,
                        value: e.id_material_proveedor
                    };
                }), '#id_material_proveedor');
                if($.isPlainObject(params) && typeof (params.params.fnCallback)==='function'){
                    console.info('Se han listado los proveedores');
                    params.params.fnCallback(params);
                }
            }
        });
    }
};
$(document).ready(function () {
    $('#id_tipo_material').on('select2:select', function (e, params) {
        $('#tipo_material').val($('#id_tipo_material option:selected').text());
        material.getAllMateriales($(this).val(), {
            event: e,
            params: params
        });
    });
    $('#id_material').on('select2:select', function (e, params) {
        material.getAllProveedoress($(this).val(), {
            event: e,
            params: params,
        });
    });
    $('#id_material_proveedor').on('select2:select', function (e, params) {
        var optionMaterial = $('#id_material option:selected');
        var optionProveedor = $('#id_material_proveedor option:selected');
        if(optionMaterial.text() == optionProveedor.text()){
            $('#descripcion').val(optionMaterial.text());
        }else{
            var descripcion = optionMaterial.text()+' '+optionProveedor.text();
            $('#descripcion').val(descripcion);
        }
        $('#cantidad').removeAttr('readonly');
        $('#litros').removeAttr('readonly');
        $('#galones').removeAttr('readonly');
        switch(parseInt(optionMaterial.val())){
            case 1||3: $('#litros').attr('readonly', 'readonly');
                    $('#galones').attr('readonly', 'readonly');
                break;
            case 2: $('#cantidad').attr('readonly', 'readonly');
                break;
            default:
                break;
        }
        if($.isPlainObject(params) && typeof (params.fnCallback)==='function'){
            console.log('Validación de controles');
            params.fnCallback(params);
        }
    });
});