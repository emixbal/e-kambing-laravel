@extends('adminlte::page')

@section('title', 'Kambing')

@section('content_header')
    <h1>Kambings</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">Kambing Detail</div>
    <div class="card-body">
        <table class="table table-striped">
        <tbody>
            <tr>
                <th class="w-25">
                    Nama
                </th>
                <td>
                    {{$kambing->name}}
                </td>
            </tr>
            <tr>
                <th class="w-25">
                    Nomer
                </th>
                <td>
                    {{$kambing->number}}
                </td>
            </tr>
            <tr>
                <th class="w-25">
                    Jenis Kelamin
                </th>
                <td>
                    {{$kambing->sex}}
                </td>
            </tr>
            <tr>
                <th class="w-25">
                    Tanggal Lahir
                </th>
                <td>
                    {{$kambing->birth_date}}
                </td>
            </tr>
        </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a class="btn btn-primary">
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
            Apakah yakin untuk {{($kambing->active)?"disable":"enable"}} user tersebut?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="disable_ok" data-id={{$kambing->id}}>Ok</button>
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