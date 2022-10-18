@extends('adminlte::page')

@section('title', 'Anggota')

@section('content_header')
    <h1>Form Anggota</h1>
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

<form method="POST" action="/anggota/{{$anggota->id}}/update" enctype="multipart/form-data" onsubmit="return confirm('Apakah data yang diisikan sudah benar?');">
    @csrf
    <div class="form-group">
        <label for="nama">Nomer Anggota</label>
        <input required maxlength="100" type="text" class="form-control"name="nomer_anggota_disabled" value="{{ $anggota->nomer_anggota }}" disabled>
    </div>

    <div class="form-group">
        <label for="nama">Nama</label>
        <input required maxlength="100" type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama" value="{{ $anggota->nama }}">
    </div>

    <div class="row">
        <div class="col-sm-3">

            <div class="form-group">
                <label for="nama">Tempat Lahir (pob)</label>
                <input required maxlength="100" type="text" class="form-control" id="pob" placeholder="Enter Tempat Lahir" name="pob" value="{{ $anggota->pob }}">
            </div>

        </div>
        <div class="col-sm-6">
            <div class="row">

                <div class="form-group col-sm-3">
                    <label for="nama">Tanggal Lahir</label>
                    <input required  min="1" max="31" type="number" class="form-control" id="day" placeholder="Enter Tanggal Lahir" name="day" value="{{ \Carbon\Carbon::parse($anggota->dob)->translatedFormat('d') }}">
                </div>

                <div class="form-group col-sm-4">
                    <label for="sel1">Bulan Lahir</label>
                    <select class="form-control" id="month" name="month" required>
                        <option value="" selected>Pilih Bulan</option>
                        <option value="1" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==1)?"selected":""}}>Januari</option>
                        <option value="2" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==2)?"selected":""}}>Februari</option>
                        <option value="3" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==3)?"selected":""}}>Maret</option>
                        <option value="4" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==4)?"selected":""}}>April</option>
                        <option value="5" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==5)?"selected":""}}>Mei</option>
                        <option value="6" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==6)?"selected":""}}>Juni</option>
                        <option value="7" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==7)?"selected":""}}>Juli</option>
                        <option value="8" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==8)?"selected":""}}>Agustus</option>
                        <option value="9" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==9)?"selected":""}}>September</option>
                        <option value="10" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==10)?"selected":""}}>Oktober</option>
                        <option value="11" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==11)?"selected":""}}>November</option>
                        <option value="12" {{(\Carbon\Carbon::parse($anggota->dob)->translatedFormat('m')==12)?"selected":""}}>Desember</option>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="nama">Tahun Lahir</label>
                    <input required min="1950" max="2050" type="number" class="form-control" id="year" placeholder="Enter Tahun Lahir" name="year" value="{{ \Carbon\Carbon::parse($anggota->dob)->translatedFormat('Y') }}">
                </div>

            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" id="alamat" placeholder="Enter Alamat" name="alamat" required>{{ $anggota->alamat }}</textarea>
    </div>

    <div class="form-group">
        <label>NIK</label>
        <input type="text" class="form-control" id="nik" value="{{ $anggota->nik }}" placeholder="Enter NIK" name="nik" required>
    </div>

    <div class="form-group">
        <label>NIP</label>
        <input type="text" class="form-control" id="nip" value="{{ $anggota->nip }}" placeholder="Enter NIP" name="nip" required>
    </div>

    <div class="form-group">
        <label for="sel1">Sumber Gaji</label>
        <select class="form-control" id="sumber_gaji" name="sumber_gaji">
            <option value="" {{(!$anggota->sumber_gaji_id)?"selected":""}}>Pilih Sumber Gaji</option>
            @foreach($sumberGajis as $sumberGaji)
            <option value="{{$sumberGaji->id}}" {{($anggota->sumber_gaji_id==$sumberGaji->id)?"selected":""}}>{{$sumberGaji->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="sel1">Unit</label>
        <select class="form-control" id="unit" name="unit">
            <option value="" {{(!$anggota->unit_id)?"selected":""}}>Pilih Unit</option>
            @foreach($units as $unit)
            <option value="{{$unit->id}}" {{($anggota->unit_id==$unit->id)?"selected":""}}>{{$unit->name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
@stop
