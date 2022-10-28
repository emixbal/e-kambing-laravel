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
    <input type="text" id="kambingId" hidden />

    <label for="email">Tambah data pemakaian obat/vaksin Ke kambing?</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control col-sm-4" placeholder="Enter nomer kambing" id="kambingNumber" />
        <div class="input-group-append">
            <button class="btn btn-success" type="button" id="searchBtn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    {{-- #modalKambingDetail --}}
    <div class="modal fade" id="modalKambingDetail" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title font-weight-bold">Tambah Pemberian {{ $medicine->name }} Ke Hewan Berikut?</p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="w-25">
                                    Number
                                </th>
                                <td>
                                    <span id="kambingNumberHtml"></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">
                                    Nama
                                </th>
                                <td>
                                    <span id="kambingNameHtml"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <input type="number" class="form-control" id="medicineDosing" placeholder="Masukkan jumlah dosis">
                    </div>
                </div>
                <!-- end Modal body -->

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" id="massMediciningBtnNo">
                        Tidak
                    </button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id="massMediciningBtnOk">
                        Ya, lanjutkan
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- end #modalKambingDetail --}}


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/medicine/medicine_detail.js') }}"></script>
@stop
