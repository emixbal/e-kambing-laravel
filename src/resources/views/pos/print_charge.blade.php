<style>
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
.judul {
    font-size: 0.7em; /* 14px/16=0.875em */
}
.isi {
    font-size: 0.6em; /* 14px/16=0.875em */
}
div.batas {
    margin-left: 1px;
    width: 200px;
}
</style>

<div class="batas">
    <center>
        <br>
        <br>
        <span class="judul">{{$nama_perusahaan}}</span>
        <br>
        <span class="judul">{{$alamat_perusahaan}}</span>
        <hr />
    </center>
    <p class="isi">ID Transaksi: {{$transaction->id}}</p>
    <p class="isi">Atas Nama: {{$transaction->anggota->nama}}</p>
    <p class="isi">Tanggal Transaksi: <br> {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y')}}</p>
    <p class="isi">Petugas: {{$transaction->petugas->name}}</p>

    <div class="judul">
        Jenis Transaksi:
        <br>
        {{$transaction->type->name}}
    </div>

    <p class="isi">Nominal: Rp @convert($transaction->nominal)</p>
    <p class="isi">Saldo Baru: Rp @convert($transaction->new_saldo)</p>

</div>