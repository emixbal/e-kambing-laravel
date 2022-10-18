@extends('adminlte::page')

@section('content_header')
    <h1>Top Up File Detail</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">File Detail</div>
    <div class="card-body">
        <table class="table table-striped">
        <tbody>
        <tr>
            <th>
                Waktu Upload
            </th>
            <td>
                {{ \Carbon\Carbon::parse($file->created_at)->translatedFormat('d F Y H:i') }}
            </td>
        </tr>
        
        <tr>
            <th>
                Nama
            </th>
            <td class="text-left">
                {{$file->name}}
            </td>
        </tr>
        
        <tr>
            <th>
                Jumlah Data (Jumlah Baris)
            </th>
            <td class="text-left">
                {{$file->total_data}}
            </td>
        </tr>

        <tr>
            <th>
                Nominal
            </th>
            <td>Rp @convert($file->nominal) ,-</td>
        </tr>
        
        <tr>
            <th>
                Total Top Up
            </th>
            <td>Rp @convert($file->total_data*$file->nominal) ,-</td>
        </tr>
        
        <tr>
            <th>
                Status
            </th>
            <td class="text-left">
                @if($file->is_done)
                <span class="badge badge-success">Selesai</span>
                @else
                <span class="badge badge-danger">Belum Selesai</span>
                @endif
            </td>
        </tr>
        
        <tr>
            <th>
                Diupload oleh
            </th>
            <td class="text-left">
                {{$file->uploader_name}}
            </td>
        </tr>

        <tr>
            <th>
                
            </th>
            <td class="text-left">
                <a href="{{route('topupFileDetailDownloadCsv', [$file->id])}}">
                    <i class="fa fa-file-excel" aria-hidden="true"></i> Download File
                </a>
            </td>
        </tr>

        <tr>
            <th>
            </th>
            <td class="text-left">
                <a href="{{route('topupByListPrintPDF', [$file->id])}}">
                    <i class="fa fa-file-pdf" aria-hidden="true"></i> Download Bukti Top Up
                </a>
            </td>
        </tr>

        </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        List Anggota Pada File
    </div>
    <div class="card-body">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>TTL</th>
                <th>Nomer Anggota</th>
                <th>Saldo Sekarang</th>
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

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
@stop