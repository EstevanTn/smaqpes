@if(session('inserted'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button class="close" data-toggle="alert" data-dismiss="alert">&times;</button>
        <strong>Guardado!</strong> {{ session('inserted') }}
    </div>
@endif

@if(session('updated'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button class="close" data-toggle="alert" data-dismiss="alert">&times;</button>
        <strong>Actualizado!</strong> {{ session('updated') }}
    </div>
@endif

@if(session('deleted'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button class="close" data-toggle="alert" data-dismiss="alert">&times;</button>
        <strong>Eliminado!</strong> {{ session('deleted') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button class="close" data-toggle="alert" data-dismiss="alert">&times;</button>
        <strong><i class="glyphicon glyphicon-ban-circle"></i> Error!</strong> {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissable" role="alert">
        <button class="close" data-toggle="alert" data-dismiss="alert">&times;</button>
        <strong><i class="glyphicon glyphicon-warning-sign"></i> Advertencia!</strong> {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissable" role="alert">
        <button class="close" data-toggle="alert" data-dismiss="alert">&times;</button>
        <strong><i class="glyphicon glyphicon-info-sign"></i> Info!</strong> {{ session('info') }}
    </div>
@endif