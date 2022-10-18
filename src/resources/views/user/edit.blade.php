@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>Form Edit User</h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action={{"/users/".$user->id."/update"}}>
    @csrf
    <div class="form-group">
        <label for="email">Email address</label>
        <input maxlength="100" type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{$user->email}}">
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter nama" name="name" value="{{$user->name}}">
    </div>

    @if(Auth::user()->id == $user->id)
    <div class="form-group">
        <label for="password">Password Baru (optional)</label>
        <input maxlength="8" type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <div class="form-group">
        <label for="password">Password Confirmed</label>
        <input maxlength="8" type="password" class="form-control" id="password" placeholder="Enter again password" name="password_confirmation">
    </div>
    @endif

    <label for="role_radio">Role</label>
    <div class="form-group">
        @foreach($roles as $role)
        <div class="form-check-inline">
            <label class="form-check-label">
                <input
                    {{(Auth::user()->id == $user->id)?"disabled":""}}
                    type="radio" class="form-check-input" name="role_radio"
                    value="{{$role->id}}"
                    {{ ($user->role_id==$role->id)? "checked" : "" }}
                />{{$role->name}}
            </label>
        </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
@stop