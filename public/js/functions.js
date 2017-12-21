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

function formReset(parent) {
    $('input[type="hidden"]', parent).each(function () {
       var exclude = $(this).data('exclude');
       if(!exclude || exclude.trim().toLocaleLowerCase() === 'false'){
           if($(this).attr('name')!=='_token' && $(this).attr('name')!=='_method'){
               $(this).val(0);
           }
       }
    });
    $('input.form-control, textarea', parent).val('');
    $('select.form-control', parent).val(0);
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

function diffTime(start, end) {
    if(typeof(start)==='string' && typeof (end)==='string'){
        start = start.split(":");
        end = end.split(":");
        start = { hours: start[0], minutes: start[1], seconds: start[2]?start[2]:0 }
        end = { hours: end[0], minutes: end[1], seconds: end[2]?end[2]:0 }
    }
    var startDate = new Date(0, 0, 0, start.hours, start.minutes, start.seconds);
    var endDate = new Date(0, 0, 0, end.hours, end.minutes, end.seconds);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);

    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}

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
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-dismiss="modal"]', '.modal-footer').addClass('pull-left');
    $('[data-toggle="timepicker"]').timepicker({ showMeridian: false, showInputs: true, defaultTime: false });
})