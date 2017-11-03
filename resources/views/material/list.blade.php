@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Materiales</h4>
    @include('partials.messages')
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
    </table>
</div>
@endsection