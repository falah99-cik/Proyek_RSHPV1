<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Rekam Medis Terbaru</h3>
    </div>

    <div class="card-body p-0">
        <table class="table m-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pet</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekamMedisBaru as $rm)
                <tr>
                    <td>{{ $rm->idrekam_medis }}</td>
                    <td>{{ $rm->nama_pet }}</td>
                    <td>{{ Str::limit($rm->diagnosa, 35) }}</td>
                </tr>
                @endforeach

                @if ($rekamMedisBaru->isEmpty())
                <tr>
                    <td colspan="3" class="text-center text-muted">Tidak ada data.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
