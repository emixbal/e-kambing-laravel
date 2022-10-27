@extends('adminlte::page')

@section('title', 'Medicine')

@section('content_header')
    <h1>Medicines</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">List Obat/Vitamin</div>
    <div class="card-body">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Kegunaan</th>
                <th>Normal Dosis</th>
                <th>Status</th>
            </tr>
        </thead>
        </table>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop