<div class="card">
    <div class="card-header">Riwayat Pindah Kandang</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Waktu Pemindahan</th>
                    <th scope="col">Nama Kandang</th>
                    <th scope="col">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @if (count($kandang_history) > 0)
                    @foreach ($kandang_history as $kh_data)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($kh_data->created_at)->translatedFormat('d F Y - H:i:s') }}
                            </td>
                            <td>
                                {{ $kh_data->kandang->name }}
                            </td>
                            <td>
                                {{ $kh_data->petugas->name }}
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</div>
