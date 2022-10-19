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
                    Jenis Kambing
                </th>
                <td>
                    {{$kambing->kambingType->name}}
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
                    {{ \Carbon\Carbon::parse($kambing->birth_date)->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <th class="w-25">
                    Type Darah
                </th>
                <td>
                    {{$kambing->bloodType->name}}
                </td>
            </tr>
            <tr>
                <th class="w-25">
                    Keterangan
                </th>
                <td>
                    {{$kambing->description}}
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

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
    <script src="{{ asset('js/user/user_detail.js')}}"></script>
@stop