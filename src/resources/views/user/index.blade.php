@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">List Users</div>
    <div class="card-body">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Akses</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <a href='{{url("/users/{$user->id}")}}''>
                    {{$user->name}}
                </a>
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{($user->active)?"Active":"Inactive"}}</td>
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