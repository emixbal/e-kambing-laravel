@extends('adminlte::page')

@section('content_header')
    <h1>List Anggota Top Up</h1>
@stop

@section('content')

@if($pre_total<1)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Belum ada list topup yang dibuat. Buat list terlebih dahulu untuk melakukan topup masal. <a href="{{route('topupByListForm')}}" class="btn btn-warning">Buat list...</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card">
    <div class="card-header">
        List Anggota (Menampilakn {{$total_data}} data)

        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#filterModal">
            Filter
        </button>
    </div>
    <div class="card-body">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>TTL</th>
                <th>Nomer Anggota</th>
                <th>Nominal Top Up</th>
                <th>Saldo Sekarang</th>
                <th>Sudah di proses?</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($anggotas as $anggota)
        <tr>
            <td>
                <a href='{{url("/anggota/{$anggota->id}")}}''>
                    {{$anggota->nama}}
                </a>
            </td>
            <td>
                {{$anggota->pob}}, {{ \Carbon\Carbon::parse($anggota->dob)->translatedFormat('d F Y') }}
            </td>
            <td>{{$anggota->nomer_anggota}}</td>
            <td>Rp @convert($anggota->nominal) ,-</td>
            <td>Rp @convert($anggota->saldo) ,-</td>
            <td>
                @if($anggota->transaction_id)
                <span class="badge badge-success">Sudah</span>
                @else
                <span class="badge badge-danger">Belum</span>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        @php
        $decreaseUrl = "";
        if($page>1){
            $decreaseUrl = $url."&page=".$page-1;
        }
        $increaseUrl = "";
        if($page<$total_pages){
            $increaseUrl = $url."&page=".$page+1;
        }
        @endphp

        
        <div class="row justify-content-end">
            <div class="col-md-3">
                <div class="input-group text-center" >
                    <select class="custom-select" id="inputGroupSelect01" onchange="location = this.value;">
                        @for ($i = 1; $i <= $total_pages; $i++)
                        <option value="{{$url}}&page={{$i}}" {{($page==$i)?"selected":""}}>Halaman {{$i}}</option>
                        @endfor
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text">dari {{$total_pages}} halaman</span>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <ul class="pagination float-right">
                    <li class="page-item"><a class="page-link" href="{{$decreaseUrl}}"><</a></li>
                    <li class="page-item"><a class="page-link" href="{{$increaseUrl}}">></a></li>
                </ul>
            </div>
        </div>

        @if($pre_total>0)
        <button class="btn btn-warning" id="run_btn_modal">
            Jalankan
        </button>
        @endif

    </div>
</div>

<!-- Modal Filter Start-->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="runTopUpModal">Filter Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/voucher/topup-listed/filter">
        @csrf
            <div class="form-group">
                <label for="nomer_anggota">Nomor Anggota</label>
                <input name="nomer_anggota" value="{{$filter_nomer_anggota}}" placeholder="Nomor Anggota" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input name="nama" value="{{$filter_nama}}" placeholder="Enter nama" type="text" class="form-control">
            </div>

            <label for="is_done">Sudah Diproses?</label>

            <div class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_done" id="is_done" value="" {{($is_done=="")?"checked":""}}>
                <label class="form-check-label" for="is_done">
                  Semua
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_done" id="is_done0" value=1 {{($is_done=="1")?"checked":""}}>
                <label class="form-check-label" for="is_done0">
                  Sudah
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_done" id="is_done1" value=0 {{($is_done=="0")?"checked":""}}>
                <label class="form-check-label" for="is_done1">
                  Belum
                </label>
              </div>
            </div>

            <label for="sort_type">Urutkan berdasar: </label>
            <div class="input-group text-center" >
                <select class="custom-select" id="sort_by" name="sort_by">
                    <option value="" {{($sort_by=="")?"selected":""}}>Default</option>
                    <option value="nama" {{($sort_by=="nama")?"selected":""}}>Nama</option>
                    <option value="saldo" {{($sort_by=="saldo")?"selected":""}}>Saldo</option>
                    <option value="is_done" {{($sort_by=="is_done")?"selected":""}}>Sudah/Belum?</option>
                </select>
            </div>
            <div class="form-group mt-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sort_type" id="sort_type" value="ASC" {{($sort_type=="ASC")?"checked":""}}>
                <label class="form-check-label" for="sort_type">
                    Dari Terkecil
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sort_type" id="sort_type0" value="DESC" {{($sort_type=="DESC")?"checked":""}}>
                <label class="form-check-label" for="sort_type0">
                    Dari Terbesar
                </label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            <a href="{{route('topupByList')}}" class="btn btn-danger btn-sm">reset</a>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Filter End-->

<!-- The sukses modal Start -->
<div class="modal" id="sukses_modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Sukses</strong>
            </div>
            <div class="modal-body">
                Berhasil top up anggota pada list...
            </div>
            <div class="modal-footer">
                <a href="{{route('topupByList')}}" class="btn btn-primary">ok</a>
            </div>
        </div>
    </div>
</div>
<!-- The sukses modal End -->

<!-- Modal Password Start-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="passwordModal">Password Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" id="password" placeholder="Password" type="password" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" id="run_btn">
                Konfirm
            </button>
        </div>
    </div>
</div>
<!-- Modal Password Start-->

<!-- The loading modal Start -->
<div class="modal" id="loading_modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
        </div>

        </div>
    </div>
</div>
<!-- The loading modal End -->

@stop

@section('css')
    
@stop

@section('js')
<script src="{{ asset('js/config.js')}}"></script>
<script src="{{ asset('js/voucher/index.js')}}"></script>
@stop