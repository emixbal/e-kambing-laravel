@extends('adminlte::page')

@section('content_header')
    <h1>Sumber Gaji</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        List Sumber Gaji
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:10%;">Nomer</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($sumberGajis as $sumberGaji)
                <tr>
                    <td>{{$no}}</td>
                    <td>
                        {{$sumberGaji->name}}
                    </td>
                    <td>{{(!$sumberGaji->is_deleted)?"Aktif":"Tidak Aktif"}}</td>
                    <td>
                        <a href="{{route('sumberGajis_edit', $sumberGaji->id)}}">edit</a>
                    </td>
                </tr>
                @php
                $no++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop