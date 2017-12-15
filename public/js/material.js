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
    getAllMateriales: function (id_tipo_material) {
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
            }
        });
    },
    getAllProveedoress: function (id_material) {
        var self = this;
        $.ajax({
            url: urlListarMateriales,
            data: {
                tipo: 'material_poveedor',
                id_material: id_material
            },
            success: function (response) {
                self.setOptions($.map(function (e) {
                    return {
                        text: e.nombre,
                        value: e.id_material_proveedor
                    };
                }), '#id_material_proveedor');
            }
        });
    }
};
$(document).ready(function () {
    $('#id_tipo_material').on('select2:select', function () {
        material.getAllMateriales($(this).val());
    });
    $('#id_material').on('select2:select', function () {
        material.getAllProveedoress($(this).val());
    });
});