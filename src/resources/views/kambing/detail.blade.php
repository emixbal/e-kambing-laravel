@extends('adminlte::page')

@section('title', 'Kambing')

@section('content_header')
    <h1>Kambings</h1>
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
            Kambing Detail

            <div class="dropdown show float-right">
                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pilih Actions
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="javascript:void(0);" id="modalAddMedecinesBtn">Obat/Vaksin</a>
                    <a class="dropdown-item" href="javascript:void(0);" id="modalPindahKandangBtn">Pindah Kandang</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th class="w-25">
                            Nama
                        </th>
                        <td>
                            {{ $kambing->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Nomer
                        </th>
                        <td>
                            {{ $kambing->number }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Jenis Kambing
                        </th>
                        <td>
                            {{ $kambing->kambingType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Jenis Kelamin
                        </th>
                        <td>
                            {{ $kambing->sex }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Tanggal Lahir
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($kambing->birth_date)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Type Darah
                        </th>
                        <td>
                            {{ $kambing->bloodType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Kandang
                        </th>
                        <td>
                            {{ $kambing->kandang->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Keterangan
                        </th>
                        <td>
                            {{ $kambing->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>

    </div>

    <input type="text" value="{{ $kambing->id }}" id="kambingId" hidden />

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">Obat/Vacine</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Kandang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Pakan</a>
    </ul>

    <div class="card">
        <div class="card-header">Riwayat Pemberian Obat/Vaksin</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Waktu Pemberian</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($medicine_history) > 0)
                        @foreach ($medicine_history as $mh_data)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($mh_data->created_at)->translatedFormat('d F Y - H:i:s') }}
                                </td>
                                <td>
                                    {{ $mh_data->medicine->name }}
                                </td>
                                <td>
                                    {{ $mh_data->petugas->name }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>


    <!-- modalAddMedecines -->
    <div class="modal" id="modalAddMedecines">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pemberian Obat/Vaksin</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                <div class="modal-body">
                    <div class="form-group">
                        <label for="sel1">Pilih Obat/Vaksin:</label>
                        <select class="form-control" id="medecineOptions">
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="medecineOk"
                        data-id={{ $kambing->id }}>
                        Ok
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- end #modalAddMedecines --}}

    {{-- #modalPindahKandang --}}
    <div class="modal" id="modalPindahKandang">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pindahkan Kandang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                <div class="modal-body">
                    <div class="form-group">
                        <label for="sel1">Pilih Kandang:</label>
                        <select class="form-control" id="kandangOptions">
                            @foreach ($kandangs as $kandang)
                                <option value="{{ $kandang->id }}"
                                    {{ $kandang->id == $kambing->kandang->id ? 'disabled' : '' }}>
                                    {{ $kandang->name }}
                                    {{ $kandang->id == $kambing->kandang->id ? '(posisi sekarang)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="kandangOk"
                        data-id={{ $kambing->id }}>
                        Ok
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- end #modalPindahKandang --}}


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/kambing/kambing_detail.js') }}"></script>
@stop
