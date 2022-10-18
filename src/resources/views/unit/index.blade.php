@extends('adminlte::page')

@section('content_header')
    <h1>Unit</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        List Unit
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
                @foreach ($units as $unit)
                <tr>
                    <td>{{$no}}</td>
                    <td>
                        {{$unit->name}}
                    </td>
                    <td>{{(!$unit->is_deleted)?"Aktif":"Tidak Aktif"}}</td>
                    <td>
                        <a href="{{route('units_edit', $unit->id)}}">edit</a>
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