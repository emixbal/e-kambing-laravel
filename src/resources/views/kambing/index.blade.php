@extends('adminlte::page')

@section('title', 'Kambing')

@section('content_header')
    <h1>Kambings</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">List Kambings</div>
    <div class="card-body">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($kambings as $kambing)
        <tr>
            <td>
                <a href='{{url("/kambings/{$kambing->id}")}}''>
                    {{$kambing->name}}
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop