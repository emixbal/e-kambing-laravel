@extends('adminlte::page')

@section('content_header')
    <h1>Anggota</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        List Anggota (Menampilkan {{$total_data}} data)
        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#filterModal">
            Filter & urutkan
        </button>
    </div>
    <div class="card-body">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>TTL</th>
                <th>Nomer Anggota</th>
                <th>Saldo</th>
                <th>Status</th>
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
            <td>Rp @convert($anggota->saldo) ,-</td>
            <td>{{($anggota->active)?"Aktif":"Non Aktif"}}</td>
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
        <form method="POST" action="/anggota/filter">
        @csrf
            <div class="form-group">
                <label for="nomer_anggota">Nomor Anggota</label>
                <input name="nomer_anggota" value="{{$filter_nomer_anggota}}" placeholder="Nomor Anggota" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input name="nama" value="{{$filter_nama}}" placeholder="Enter nama" type="text" class="form-control">
            </div>

            <label for="is_active">Non/Aktif?</label>

            <div class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="is_active" value="" {{($is_active=="")?"checked":""}}>
                <label class="form-check-label" for="is_active">
                  Semua
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="is_active0" value=1 {{($is_active=="1")?"checked":""}}>
                <label class="form-check-label" for="is_active0">
                  Aktif
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="is_active1" value=0 {{($is_active=="0")?"checked":""}}>
                <label class="form-check-label" for="is_active1">
                  Non Aktif
                </label>
              </div>
            </div>

            <label for="sort_type">Urutkan berdasar: </label>
            <div class="input-group text-center" >
                <select class="custom-select" id="sort_by" name="sort_by">
                    <option value="" {{($sort_by=="")?"selected":""}}>Semua</option>
                    <option value="nama" {{($sort_by=="nama")?"selected":""}}>Nama</option>
                    <option value="saldo" {{($sort_by=="saldo")?"selected":""}}>Saldo</option>
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
            <a href="{{url('anggota')}}" class="btn btn-danger btn-sm">reset</a>
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop