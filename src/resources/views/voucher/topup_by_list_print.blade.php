<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
@page {
    size: A4;
    margin: 0;
}

div.batas {
    padding: 20px;
}

table {
    width:100%;
}

table.garis, th.garis, td.garis {
    border: 1px solid black;
    border-collapse: collapse;
}
tr {
    line-height: 20px;
}
td {
    padding:4 4 4 6px;
}
</style>

<div class="batas">
    <span class="judul">{{$nama_perusahaan}}</span>
    <br>
    <span class="judul">E-Voucher App</span>
    <br>
    <span class="judul">{{$alamat_perusahaan}}</span>
    <br />
    <br />
    <br />

    <table class="garis">
        <tr style="line-height: 25px;">
            <td colspan="2" class="garis"><strong>Sukses Top Up Masal</strong></td>
        </tr>
        <tr>
            <td class="garis" style="width:25%;">File ID</td>
            <td class="garis">{{$topup_file->id}}</td>
        </tr>
        <tr>
            <td class="garis">Nama</td>
            <td class="garis">{{$topup_file->name}}</td>
        </tr>
        <tr>
            <td class="garis">Jumlah Data </td>
            <td class="garis">{{$topup_file->total_data}}</td>
        </tr>
        <tr>
            <td class="garis">Nominal</td>
            <td class="garis">Rp @convert($topup_file->nominal) ,-</td>
        </tr>
        <tr>
            <td class="garis">Total Top Up</td>
            <td class="garis">Rp @convert($topup_file->nominal*$topup_file->total_data) ,-</td>
        </tr>
        <tr>
            <td class="garis">Status</td>
            <td class="garis" class="text-left">
                @if($topup_file->is_done)
                <span>Selesai</span>
                @else
                <span>Belum Selesai</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="garis">Petugas Upload</td>
            <td class="garis">{{$topup_file->uploader_name}}</td>
        </tr>
        <tr>
            <td class="garis">Waktu Upload</td>
            <td class="garis">
                {{ \Carbon\Carbon::parse($topup_file->created_at)->translatedFormat('d F Y H:i') }}
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table>
        <tr style="line-height: 25px;">
            <td style="text-align: center; width:50%;">
                Manager
                <br/>
                <br/>
                <br/>
                <br/>
                (____________)
            </td>
            <td style="text-align: center;">
                Petugas
                <br/>
                <br/>
                <br/>
                <br/>
                ({{$topup_file->uploader_name}})
            </td>
        </tr>
    </table>
</div>