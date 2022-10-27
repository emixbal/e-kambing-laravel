<div class="card">
    <div class="card-header">Riwayat Pemberian Obat/Vaksin</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Waktu Pemberian</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @if (count($medicine_history) > 0)
                    @foreach ($medicine_history as $mh_data)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($mh_data->created_at)->translatedFormat('d F Y - H:i:s') }}
                            </td>
                            <td>
                                {{ $mh_data->medicine->name }}
                            </td>
                            <td>
                                {{ $mh_data->petugas->name }}
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</div>
