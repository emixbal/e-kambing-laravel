<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<h5>Laporan Penggunaan Voucher Di Toko</h5>
    <h5>{{$nama_perusahaan}}</h5>
	<small>{{$alamat_perusahaan}}</small>

    <br>
    <br>

    <table style="width:100%">
        <tr>
            <th>No</th>
            <th>Waktu</th>
            <th>Nama Anggota</th>
            <th>Nomer Anggota</th>
            <th>Nominal (Rp)</th>
            <th>Petugas</th>
        </tr>

        @php
        $total_nominal = 0;
        $no = 1;
        @endphp

        @foreach ($transactions as $transaction)
        <tr>
            <td>{{$no}}</td>
            <td>
                {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y - H:i:s') }}
            </td>
            <td>{{$transaction->anggota->nama}}</td>
            <td>{{$transaction->anggota->nomer_anggota}}</td>
            <td style="text-align:right;">@convert($transaction->nominal)</td>
            <td>{{$transaction->petugas->name}}</td>
        </tr>
        @php
        $no++;
        $total_nominal = $total_nominal+$transaction->nominal;
        @endphp
        
        @endforeach
    </table>

    <br><br>

    <table >
        <tr>
            <th>
                Periode
            </th>
            <td>
                {{$month}}, {{$year}}
            </td>
        </tr>
        <tr>
            <th>
                Detail Tanggal Periode
            </th>
            <td>
                {{ \Carbon\Carbon::parse($start_periode)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($end_periode)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <th>
                Total data
            </th>
            <td>
                {{count($transactions)}}
            </td>
        </tr>

        <tr>
            <th>
                Total Nominal
            </th>
            <td>
                Rp @convert($total_nominal) ,-
            </td>
        </tr>
    </table>
 
</body>
</html>
