@extends('adminlte::page')

@section('title', 'Medicine')

@section('content_header')
    <h1>Medicine</h1>
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
        <div class="card-header">
            Medicine Detail
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th class="w-25">
                            Nama
                        </th>
                        <td>
                            {{ $medicine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Keterangan
                        </th>
                        <td>
                            {{ $medicine->description }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Dosis Dianjurkan
                        </th>
                        <td>
                            {{ $medicine->dosing }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Dosis Jumlah Pemberian
                        </th>
                        <td>
                            {{ $medicine->dosing_times }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Dosis Interval Pemberian
                        </th>
                        <td>
                            {{ $medicine->dosing_interval }} (Jam)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="text" value="{{ $medicine->id }}" id="medicineId" hidden />

    <label for="email">Tambah data pemakaian obat/vaksin Ke kambing?</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control col-sm-4" placeholder="Enter nomer kambing" id="kambingNumber" />
        <div class="input-group-append">
            <button class="btn btn-success" type="button" id="searchBtn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/medicine/medicine_detail.js') }}"></script>
@stop
