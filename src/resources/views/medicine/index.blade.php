@extends('adminlte::page')

@section('title', 'Medicine')

@section('content_header')
    <h1>Medicines</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">List Obat/Vitamin</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Kegunaan</th>
                        <th>Normal Dosis</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($medicines as $medicine)
                        <tr>
                            <td>
                                <a href='{{ url("/medicines/{$medicine->id}") }}''>
                                    {{ $medicine->name }}
                                </a>
                            </td>
                            <td>{{ $medicine->description }}</td>
                            <td>{{ $medicine->dosing }}</td>
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
    <script>
        console.log('Hi!');
    </script>
@stop
