<div class="card">
    <div class="card-header">Riwayat Pakan</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Waktu Pemakanan</th>
                    <th scope="col">Nama Pakan</th>
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
                                {{ $kh_data->pakan->name }}
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
