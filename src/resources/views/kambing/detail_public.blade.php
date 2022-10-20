<!DOCTYPE html>
<html lang="en">

<head>
    <title>KambingApp - Show Kambing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/kambing/search_form.js') }}"></script>
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">KambingApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('kambingSearchForm')}}">Cari Kambing</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top:30px">

        <div class="card">
            <div class="card-header">Kambing Detail</div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th class="w-25">
                                Nama
                            </th>
                            <td>
                                {{ $kambing->name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                Nomer
                            </th>
                            <td>
                                {{ $kambing->number }}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                Jenis Kambing
                            </th>
                            <td>
                                {{ $kambing->kambingType->name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                Jenis Kelamin
                            </th>
                            <td>
                                {{ $kambing->sex }}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                Tanggal Lahir
                            </th>
                            <td>
                                {{ \Carbon\Carbon::parse($kambing->birth_date)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                Type Darah
                            </th>
                            <td>
                                {{ $kambing->bloodType->name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-25">
                                Keterangan
                            </th>
                            <td>
                                {{ $kambing->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- end of .conatiner --}}
</body>

</html>
