@extends('adminlte::page')

@section('title', 'Kandang')

@section('content_header')
    <h1>Kandangs</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">List Kandangs</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kandangs as $kandang)
                        <tr>
                            <td>
                                <a href='{{ url("/kandangs/{$kandang->id}") }}''>
                                    {{ $kandang->name }}
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
    <script>
        console.log('Hi!');
    </script>
@stop
