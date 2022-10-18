@extends('adminlte::page')

@section('title', 'POS')

@section('content_header')
    <h1>POS Tranksaksi</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        List POS Tranksaksi (Menampilkan {{$total_data}} data)
        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#filterModal">
            Filter & Print
        </button>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th  style="width:20%">Waktu</th>
                    <th>Nama Anggota</th>
                    <th>Nomer Anggota</th>
                    <th scope="col" style="text-align:right;">Nominal (Rp)</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y - H:i:s') }}
                    </td>
                    <td>{{$transaction->anggota->nama}}</td>
                    <td>{{$transaction->anggota->nomer_anggota}}</td>
                    <td style="text-align:right;">@convert($transaction->nominal)</td>
                    <td>{{$transaction->petugas->name}}</td>
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

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/pos/transactions/filter">
        @csrf
            <div class="form-group">
                <label for="sel1">Bulan Transaksi</label>
                <select class="form-control" id="month" name="month" required>
                    <option value="" selected>Pilih Bulan</option>
                    <option value="1" {{($month==1)?"selected":""}}>Januari</option>
                    <option value="2" {{($month==2)?"selected":""}}>Februari</option>
                    <option value="3" {{($month==3)?"selected":""}}>Maret</option>
                    <option value="4" {{($month==4)?"selected":""}}>April</option>
                    <option value="5" {{($month==5)?"selected":""}}>Mei</option>
                    <option value="6" {{($month==6)?"selected":""}}>Juni</option>
                    <option value="7" {{($month==7)?"selected":""}}>Juli</option>
                    <option value="8" {{($month==8)?"selected":""}}>Agustus</option>
                    <option value="9" {{($month==9)?"selected":""}}>September</option>
                    <option value="10" {{($month==10)?"selected":""}}>Oktober</option>
                    <option value="11" {{($month==11)?"selected":""}}>November</option>
                    <option value="12" {{($month==12)?"selected":""}}>Desember</option>
                </select>
            </div> 

            <div class="form-group">
                <label for="nama">Tahun</label>
                <input name="year" id="year" value="{{$year}}" placeholder="Tahun" type="text" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            <a href="{{url('pos/transactions')}}" class="btn btn-danger btn-sm">reset</a>
            <button type="button" id="is_pdf_btn" class="btn btn-success btn-sm float-right">Cetak PDF</button>
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
<script src="{{ asset('js/config.js')}}"></script>
<script src="{{ asset('js/pos/list.js')}}"></script>
@stop