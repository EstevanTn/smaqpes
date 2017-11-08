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

function verificate_delete(e) {
    e.preventDefault();
    e.stopPropagation();
    BootstrapDialog.confirm({
        title: 'Eliminando',
        message: '¿Desea eliminar el registro?',
        callback: function (result) {
            if(result){
                $('#frmDelete').get(0).submit();
            }
        }
    });
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

function formReset() {
    $('input[type="hidden"]').each(function () {
       if($(this).attr('name')!=='_token'){
           $(this).val(0);
       }
    });
    $('input.form-control, textarea').val('');
    $('select.form-control').val(0);
}

$.validator.setDefaults({
    highlight: function (label) {
        $(label).closest('.form-group').addClass('has-error');
    },
    unhighlight: function (label) {
        $(label).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function (error, element) {
        if (element.parent('.input-group').length || element.parent('.required-select2').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$(document).ready(function () {
    $.ajaxSetup({
        type: 'POST',
        data: {},
        headers: {
            'X-CSRF-TOKEN' : $('[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            $('#error-div').html(xhr.responseText);
        }
    });
    $('select').select2({
        theme: 'classic'
    });
    $('[data-toggle="datepicker"]').datepicker({
        autoclose: true,
        language: 'es',
        format: 'yyyy-m-d'
    });
})