<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Pemilik Terbaru</h3>
    </div>

    <div class="card-body p-2">
        @foreach ($pemilikBaru as $item)
        <div class="d-flex align-items-center border-bottom py-2">
            <div class="flex-grow-1">
                <strong>{{ $item->nama }}</strong>
                <div class="text-muted small">
                    WA: {{ $item->no_wa }}
                </div>
            </div>
        </div>
        @endforeach

        @if ($pemilikBaru->isEmpty())
            <p class="text-center text-muted">Belum ada data.</p>
        @endif
    </div>
</div>
