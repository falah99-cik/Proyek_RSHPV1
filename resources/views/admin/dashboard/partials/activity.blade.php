<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">Aktivitas Terbaru</h5>
    </div>

    <div class="card-body">
        @forelse ($activities as $act)
            <div class="d-flex mb-3">
                <div class="me-3">
                    <i class="bi {{ $act['icon'] }} fs-3 text-primary"></i>
                </div>
                <div>
                    <strong>{{ $act['title'] }}</strong><br>
                    <span>{{ $act['desc'] }}</span><br>
                    <small class="text-muted">{{ $act['waktu']->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada aktivitas.</p>
        @endforelse
    </div>
</div>
