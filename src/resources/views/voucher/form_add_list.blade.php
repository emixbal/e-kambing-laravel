@extends('adminlte::page')

@section('content_header')
    <h1>Form List Top Up</h1>
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

<form method="POST" action="/voucher/form-topup-listed" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nama">Nama Top Up</label>
        <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter nama (contoh: honorer Juni 2022)" name="name" value="{{ old('name') }}">
    </div>

    <div class="form-group">
        <label for="nominal">Nominal</label>
        <input required min="5000" max="500000" type="number" class="form-control" id="nominal" placeholder="Enter Nominal" name="nominal" value="{{ old('nominal') }}">
    </div>

    <div class="form-group">
        <label for="nama">Pilih File Excel</label>
        <input type="file" class="form-control-file border" name="csv_file"> 
    </div>

    <div class="form-group">
        <label for="nama">Password</label>
        <input maxlength="10" type="password" class="form-control" id="password" placeholder="Konfirmasi Password" name="password">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
@stop