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

<form method="POST" action="/anggota/new" enctype="multipart/form-data" onsubmit="return confirm('Apakah data yang diisikan sudah benar?');">
    @csrf
    <div class="form-group">
        <label for="nama">Nama</label>
        <input required maxlength="100" type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama" value="{{ old('nama') }}">
    </div>

    <div class="row">
        <div class="col-sm-3">
        
            <div class="form-group">
                <label for="nama">Tempat Lahir (pob)</label>
                <input required maxlength="100" type="text" class="form-control" id="pob" placeholder="Enter Tempat Lahir" name="pob" value="{{ old('pob') }}">
            </div>
        
        </div>
        <div class="col-sm-6">
            <div class="row">
                
                <div class="form-group col-sm-3">
                    <label for="nama">Tanggal Lahir</label>
                    <input required  min="1" max="31" type="number" class="form-control" id="day" placeholder="Enter Tanggal Lahir" name="day" value="{{ old('day') }}">
                </div>

                <div class="form-group col-sm-4">
                    <label for="sel1">Bulan Lahir</label>
                    <select class="form-control" id="month" name="month" required>
                        <option value="" selected>Pilih Bulan</option>
                        <option value="1" {{(old('month')==1)?"selected":""}}>Januari</option>
                        <option value="2" {{(old('month')==2)?"selected":""}}>Februari</option>
                        <option value="3" {{(old('month')==3)?"selected":""}}>Maret</option>
                        <option value="4" {{(old('month')==4)?"selected":""}}>April</option>
                        <option value="5" {{(old('month')==5)?"selected":""}}>Mei</option>
                        <option value="6" {{(old('month')==6)?"selected":""}}>Juni</option>
                        <option value="7" {{(old('month')==7)?"selected":""}}>Juli</option>
                        <option value="8" {{(old('month')==8)?"selected":""}}>Agustus</option>
                        <option value="9" {{(old('month')==9)?"selected":""}}>September</option>
                        <option value="10" {{(old('month')==10)?"selected":""}}>Oktober</option>
                        <option value="11" {{(old('month')==11)?"selected":""}}>November</option>
                        <option value="12" {{(old('month')==12)?"selected":""}}>Desember</option>
                    </select>
                </div> 

                <div class="form-group col-sm-3">
                    <label for="nama">Tahun Lahir</label>
                    <input required min="1950" max="2050" type="number" class="form-control" id="year" placeholder="Enter Tahun Lahir" name="year" value="{{ old('year') }}">
                </div>

            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" id="alamat" placeholder="Enter Alamat" name="alamat" required>{{ old('alamat') }}</textarea>
    </div>
    
    <div class="form-group">
        <label>NIK</label>
        <input type="text" class="form-control" id="nik" value="{{ old('nik') }}" placeholder="Enter NIK" name="nik" required>
    </div>

    <div class="form-group">
        <label>NIP</label>
        <input type="text" class="form-control" id="nip" value="{{ old('nip') }}" placeholder="Enter NIP" name="nip" required>
    </div>

    <div class="form-group">
        <label for="sel1">Sumber Gaji</label>
        <select class="form-control" id="sumber_gaji" name="sumber_gaji">
            <option {{(old('sumberGaji')=="")?"selected":""}} value="">Pilih Sumber Gaji</option>
            @foreach($sumberGajis as $sumberGaji)
            <option value="{{$sumberGaji->id}}" {{(old('sumberGaji')==$sumberGaji->id)?"selected":""}}>{{$sumberGaji->name}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="sel1">Unit</label>
        <select class="form-control" id="unit" name="unit">
            <option {{(old('unit')=="")?"selected":""}} value="">Pilih Unit</option>
            @foreach($units as $unit)
            <option value="{{$unit->id}}" {{(old('unit')==$unit->id)?"selected":""}}>{{$unit->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Foto Anggota</label>
        <input type="file" class="form-control" name="image" required accept="image/*" value="{{ old('image') }}">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
@stop