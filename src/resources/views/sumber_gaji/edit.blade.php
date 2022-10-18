@extends('adminlte::page')

@section('content_header')
    <h1>Form Edit Sumber Gaji</h1>
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


<form method="POST" action="/sumber_gaji/{{$sumberGaji->id}}/edit"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nama</label>
        <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter nama sumber gaji" name="name" value="{{$sumberGaji->name}}" />
    </div>

    <label for="sumberGaji_active">Aktif/tidak aktif?</label>
    <div class="form-group">
        <div class="form-check-inline">
            <label class="form-check-label">
                <input
                    type="radio" class="form-check-input" name="active" value="1"
                    {{ ($sumberGaji->is_deleted==0)? "checked" : "" }}
                />Aktif

                <input
                    type="radio" class="form-check-input" name="active" value="0"
                    {{ ($sumberGaji->is_deleted==1)? "checked" : "" }}
                />Tidak Aktif
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop