@extends('adminlte::page')

@section('title', 'Topup Anggota')

@section('content_header')
    <h1>Form Topup Anggota</h1>
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


<div class="card">
    <div class="card-header">Anggota Detail</div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>
                        Nama
                    </th>
                    <td>
                        {{$anggota->nama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Nomer Anggota
                    </th>
                    <td>
                        {{$anggota->nomer_anggota}}
                    </td>
                </tr>
                <tr>
                    <th>
                        NIK
                    </th>
                    <td>
                        {{$anggota->nik}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Alamat
                    </th>
                    <td>
                        {{$anggota->alamat}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Saldo saat ini
                    </th>
                    <td>
                        <strong>
                            Rp @convert($anggota->voucher->saldo)
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <input id="anggota_id" value="{{$anggota->id}}" type="hidden" >
        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input required min="5000" max="500000" type="number" class="form-control" id="nominal" placeholder="Enter Nominal" name="nominal" value="{{ old('nominal') }}">
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" id="keterangan" placeholder="Enter Keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input required min="5000" max="500000" type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="{{ old('nominal') }}">
        </div>

        <button id="topup_btn" class="btn btn-primary">Submit</button>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
    <script src="{{ asset('js/anggota/topup.js')}}"></script>
@stop