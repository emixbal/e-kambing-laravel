@extends('adminlte::page')

@section('content_header')
    <h1>List File Top Up</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        List File (total data: 0)
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Waktu Upload</th>
                    <th>Name</th>
                    <th style="width: 7%">Jumlah<br>Data</th>
                    <th>Nominal (Rp)</th>
                    <th>Total Nominal (Rp)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($file->created_at)->translatedFormat('d-m-Y H:i') }}
                    </td>
                    <td>{{$file->name}}</td>
                    <td>{{$file->total_data}}</td>
                    <td class="text-right">@convert($file->nominal)</td>
                    <td class="text-right">@convert($file->total_data*$file->nominal)</td>
                    <td class="text-center">
                        @if($file->is_done)
                        <span class="badge badge-success">Selesai</span>
                        @else
                        <span class="badge badge-danger">Belum selesai</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('topupFileDetail', [$file->id])}}">
                            lihat
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/config.js')}}"></script>
@stop