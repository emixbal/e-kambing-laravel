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
    <input type="text" id="medicineIdSaved" hidden />

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $histrory_view == 'medicine' ? 'active' : '' }}"
                href="{{ $base_url . '?histrory_view=medicine' }}">Obat/Vacine</a>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $histrory_view == 'kandang' ? 'active' : '' }}"
                href="{{ $base_url . '?histrory_view=kandang' }}">Kandang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $histrory_view == 'pakan' ? 'active' : '' }}"
                href="{{ $base_url . '?histrory_view=pakan' }}">Pakan</a>
    </ul>

    @if ($histrory_view == 'medicine')
        @include('kambing.detail_medicines')
    @endif

    @if ($histrory_view == 'kandang')
        @include('kambing.detail_kandangs')
    @endif

    @if ($histrory_view == 'pakan')
        @include('kambing.detail_pakans')
    @endif


    <!-- modalAddMedecines -->
    <div class="modal fade" id="modalAddMedecines">
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
                    <div class="form-group">
                        <input type="number" class="form-control" id="medicineDosing" placeholder="Masukkan jumlah dosis">
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
    <div class="modal fade" id="modalPindahKandang">
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

    {{-- #modalAddMedecinesSuccess --}}
    <div class="modal fade" id="modalAddMedecinesSuccess">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <strong class="modal-title">Pemberian Obat/Vaksin berhasim di simpan</strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                <div class="modal-body">
                    <p>
                        Lanjautkan pemberian obat/vaksin ke ternak yang lain?
                    </p>
                </div>
                <!-- end Modal body -->

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" id="massMediciningBtnNo">Tidak</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id="massMediciningBtnOk">
                        Ya, lanjutkan
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- end #modalAddMedecinesSuccess --}}


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/kambing/kambing_detail.js') }}"></script>
@stop
