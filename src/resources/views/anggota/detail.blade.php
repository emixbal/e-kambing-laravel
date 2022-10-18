@extends('adminlte::page')

@section('title', 'Anggota')

@section('content_header')
    <h1>Anggota</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">Anggota Detail</div>
    <div class="card-body">
        <table class="table table-striped">
        <tbody>
        <tr>
            <th>
                Nama
            </th>
            <td>
                {{$anggota->nama}}
            </td>
        </tr>
        <tr>
            <th>
                Nomer Anggota
            </th>
            <td>
                {{$anggota->nomer_anggota}}
            </td>
        </tr>

        <tr>
            <th>
                Alamat
            </th>
            <td>
                {{$anggota->alamat}}
            </td>
        </tr>
        
        <tr>
            <th>
                TTL
            </th>
            <td>
                {{$anggota->pob}}, {{ \Carbon\Carbon::parse($anggota->dob)->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <th>
                NIK
            </th>
            <td>
                {{$anggota->nik}}
            </td>
        </tr>
        
        <tr>
            <th>
                NIP
            </th>
            <td>
                {{$anggota->nip}}
            </td>
        </tr>
        
        <tr>
            <th>
                Unit
            </th>
            <td>
                {{$anggota->unit->name}}
            </td>
        </tr>

        <tr>
            <th>
                Sumber Gaji
            </th>
            <td>
                {{$anggota->sumberGaji->name}}
            </td>
        </tr>

        <tr>
            <th>
                Status
            </th>
            <td>
                @if($anggota->active)
                <span class="badge badge-success">Enable</span>
                @else
                <span class="badge badge-dark">Disable</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>
                Foto
            </th>
            <td>
                <img src="{{ route('show_image', ['id' => $anggota->id]) }}" style="width: 150px;" alt="Avatar" />
            </td>
        </tr>
        
        </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDisable">
            {{($anggota->active)?"Disable":"Enable"}}
        </button>
        <a class="btn btn-primary" href="{{route('anggotas_edit', $anggota->id)}}" >
            Edit
        </a>

        <a class="btn btn-success" href="{{route('anggota_topup', $anggota->id)}}">
            Topup Saldo Voucher
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>
            Saldo Voucher: <strong> Rp @convert($anggota->voucher->saldo)</strong>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-header">Informasi List Semua Transaksi</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Waktu Input</th>
                    <th scope="col">Type</th>
                    <th scope="col" style="text-align:right;">Nominal (Rp)</th>
                    <th scope="col" style="width:40%;">Keterangan</th>
                    <th scope="col">Saldo Ahir (Rp)</th>
                    <th scope="col">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @if(count($transactions)>0)
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y - H:i:s') }}
                            </td>
                            <td>{{$transaction->type->name}}</td>
                            <td style="text-align:right;">@convert($transaction->nominal)</td>
                            <td>{{($transaction->keterangan)?$transaction->keterangan:"-"}}</td>
                            <td style="text-align:right;">@convert($transaction->new_saldo)</td>
                            <td>{{$transaction->petugas->name}}</td>
                        </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>



    </div>
</div>

<!-- The Modal -->
<div class="modal" id="modalConfirmDisable">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            Apakah yakin untuk {{($anggota->active)?"disable":"enable"}} anggota tersebut?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="disable_ok" data-id={{$anggota->id}}>Ok</button>
        </div>

        </div>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
    <script src="{{ asset('js/anggota/anggota_detail.js')}}"></script>
@stop