function delete_reg(url) {
    BootstrapDialog.confirm({
        title: 'Eliminando',
        message: '¿Desea eliminar el registro?',
        callback: function(result){
            if(result)
                window.location.href = url;
        }
    })
}

function selectOption(name, option) {
    var fnSelected = function (a, b) {
        $(a).val(b).trigger('change');
    }
    if(typeof(name)==='string' && (typeof(option) === 'string' || typeof(option) === 'number')){
        fnSelected(name, option);
    }else{
        if(Array.isArray(name) && Array.isArray(option)){
            $.each(name, function (i, ele) {
                console.log(name[i]);
               fnSelected(name[i], option[i]);
            });
        }else{
            if($.isPlainObject(name) && typeof(option) === 'undefined'){
                $.map(name, function(e, i){
                    fnSelected('#'+i, e);
                });
            }else{
                throw new Error('Argumentos no válidos.');
            }
        }
    }
}

$(document).ready(function () {
    $('select').select2({
        theme: 'classic'
    });
})