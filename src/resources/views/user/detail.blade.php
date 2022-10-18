@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">User Detail</div>
    <div class="card-body">
        <table class="table table-striped">
        <tbody>
        <tr>
            <th>
                Nama
            </th>
            <td>
                {{$user->name}}
            </td>
        </tr>
        <tr>
            <th>
                Email
            </th>
            <td>
                {{$user->email}}
            </td>
        </tr>
        <tr>
            <th>
                Akses
            </th>
            <td>{{$user->role->name}}</td>
        </tr>
        <tr>
            <th>
                Status
            </th>
            <td>
                @if($user->active)
                <span class="badge badge-success">Active</span>
                @else
                <span class="badge badge-dark">Inactive</span>
                @endif
            </td>
        </tr>
        </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDisable" {{(Auth::user()->id == $user->id)?"disabled":""}}>
            {{($user->active)?"Disable":"Enable"}}
        </button>
        <a class="btn btn-primary" href="{{route('users_edit', $user->id)}}">
            Edit
        </a>
    </div>

</div>

<!-- The Modal -->
<div class="modal" id="modalConfirmDisable">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            Apakah yakin untuk {{($user->active)?"disable":"enable"}} user tersebut?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="disable_ok" data-id={{$user->id}}>Ok</button>
        </div>

        </div>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
    <script src="{{ asset('js/user/user_detail.js')}}"></script>
@stop