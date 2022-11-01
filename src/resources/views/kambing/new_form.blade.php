@extends('adminlte::page')

@section('title', 'Kambing')

@section('content_header')
    <h1>Form Kambings</h1>
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

    <form method="POST" action="/kambings/store">
        @csrf
        <div class="col-sm-6">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter nama" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="nama">Nomer</label>
                <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter Nomer" name="number" value="{{ old('number') }}">
            </div>
            {{-- <div class="form-group">
                <label for="nama">Tanggal Lahir</label>
                <input maxlength="100" type="text" class="form-control" id="name" placeholder="Enter Tanggal Lahir" name="birth_date" value="{{ old('birth_date') }}">
            </div> --}}

            <div>
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

            <label for="nama">Jenis Kelamin</label>
            <div class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="male" name="sex_radio" {{ (old('sex_radio')=="male")?"checked":"" }} >Jantan
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="female" name="sex_radio" {{ (old('sex_radio')=="female")?"checked":"" }}>Betina
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="sel1">Kandang</label>
                <select class="form-control" id="kandang_id" name="kandang_id">
                    <option value="">Pilih Kandang</option>
                    @foreach($kandangs as $kandang)
                    <option value="{{$kandang->id}}" {{ (old('kandang_id')==$kandang->id)?"selected":"" }}>{{$kandang->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="sel1">Jenis Kambing</label>
                <select class="form-control" id="kambing_type_id" name="kambing_type_id">
                    <option value="">Pilih Jenis Kambing</option>
                    @foreach($kambing_types as $kambing_type)
                    <option value="{{$kambing_type->id}}" {{ (old('kambing_type_id')==$kambing_type->id)?"selected":"" }}>{{$kambing_type->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="sel1">Jenis Keturunan</label>
                <select class="form-control" id="blood_type_id" name="blood_type_id">
                    <option value="">Pilih Jenis Keturunan</option>
                    @foreach($blood_types as $blood_type)
                    <option value="{{$blood_type->id}}" {{ (old('blood_type_id')==$blood_type->id)?"selected":"" }}>{{$blood_type->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="sel1">Induk Jantan</label>
                <select class="form-control" id="induk_jantan_id" name="induk_jantan_id">
                    <option value="">Pilih Induk Jantan</option>
                    @foreach($male_kambings as $male_kambing)
                    <option value="{{$male_kambing->id}}" {{ (old('induk_jantan_id')==$male_kambing->id)?"selected":"" }}>{{$male_kambing->number}} - {{$male_kambing->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sel1">Induk Betina</label>
                <select class="form-control" id="induk_betina_id" name="induk_betina_id">
                    <option value="">Pilih Induk Betina</option>
                    @foreach($female_kambings as $female_kambing)
                    <option value="{{$female_kambing->id}}" {{ (old('induk_betina_id')==$female_kambing->id)?"selected":"" }}>{{$female_kambing->number}} - {{$female_kambing->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Keterangan:</label>
                <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter Keterangan">{{ old('description') }}</textarea>
            </div> 

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/config.js') }}"></script>
@stop
