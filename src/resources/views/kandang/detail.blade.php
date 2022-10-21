@extends('adminlte::page')

@section('title', 'Kandang')

@section('content_header')
    <h1>Kandang</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Kandang Detail
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th class="w-25">
                            Nama
                        </th>
                        <td>
                            {{ $kandang->name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Nomer
                        </th>
                        <td>
                            {{ $kandang->number }}
                        </td>
                    </tr>
                    <tr>
                        <th class="w-25">
                            Keterangan
                        </th>
                        <td>
                            {{ $kandang->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>

    </div>

    <input type="text" value="{{ $kandang->id }}" id="kandangId" hidden />

    <div class="card">
        <div class="card-header">List kambing dikandang</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nomer Kambing</th>
                        <th scope="col">Jennis Kambing</th>
                        <th scope="col">Nama Kambing</th>
                        <th scope="col">Jennis Kelamin</th>
                        <th scope="col">Umur</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($kambings) > 0)
                        @foreach ($kambings as $kambing)
                            <tr>
                                <td>
                                    <a href='{{url("/kambings/{$kambing->id}")}}''>
                                        {{$kambing->number}}
                                    </a>
                                </td>
                                <td>
                                    {{ $kambing->kambingType->name }}
                                </td>
                                <td>
                                    {{ $kambing->name }}
                                </td>
                                <td>
                                    {{ $kambing->sex }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->diffInMonths($kambing->birth_date) }} bulan
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/kandang/kandang_detail.js') }}"></script>
@stop
