@extends('adminlte::page')

@section('content_header')
    <h1>Form Tambah Sumber Gaji</h1>
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


<form method="POST" action="/sumber_gaji/new"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nama</label>
        <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter nama sumber gaji" name="name" value="{{ old('name') }}" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop