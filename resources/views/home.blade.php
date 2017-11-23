@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">GRUPO CAVENAGO</h4>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-responsive" src="{{ asset('img/logo_JC-division-rental-maquinarias.png') }}"/>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    Usted ha iniciado sesión como <strong>{{ Auth::user()->name }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
