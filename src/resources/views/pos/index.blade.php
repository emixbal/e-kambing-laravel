@extends('adminlte::page')

@section('title', 'POS')

@section('content_header')
    <h1>POS Tranksaksi</h1>
@stop

@section('content')

<div class="form-inline">
    <div class="form-group mx-md-6 mr-1">
        <label for="nomer_anggota" class="sr-only"> Nomer Anggota</label>
        <input maxlength="20" type="nomer_anggota" class="form-control" placeholder="Enter Nomer Anggota" id="nomer_anggota" autofocus>
    </div>
    <span id="indikator_user_is_loading"></span>
</div>

<div id="indikator_user_is_found"></div>

<div class="card mt-2" id="anggota_detail">
    <input type="text" id="id_anggota" hidden>
    <input type="text" id="saldo" hidden>
    <div class="card-header">Anggota Detail</div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>
                        Nomer Anggota
                    </th>
                    <td>
                        <span id="nomor_anggota_html">Nomer Anggota</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        Nama Anggota
                    </th>
                    <td>
                        <span id="nama_anggota_html">Nama Anggota</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        Total Saldo
                    </th>
                    <td>
                        Rp. <span id="saldo_anggota_html">Saldo Anggota</span> ,-
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-2" id="anggota_bayar">
    <div class="card-header">Form Pembayaran Dengan Voucher</div>
    <div class="card-body row">
        <div class="form-group col-lg-3">
            <label for="nominal">Nominal Pembayaran</label>
            <input maxlength="7" type="number" class="form-control form-control-lg" id="nominal" placeholder="Enter nominal" name="nominal">
        </div>

        <div class="form-group col-lg-3">
            <label for="password">Password Anggota</label>
            <input maxlength="8" type="password" class="form-control form-control-lg" id="password" placeholder="Enter password" name="password">
        </div>

        <button 
            class="btn btn-primary float-right col-sm-2" id="bayar_btn"
        >
            Bayar
        </button>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
<script src="{{ asset('js/config.js')}}"></script>
<script src="{{ asset('js/pos/index.js')}}"></script>
@stop