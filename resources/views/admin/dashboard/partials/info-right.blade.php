<div class="info-box mb-3 text-bg-primary">
    <span class="info-box-icon"><i class="bi bi-paw-fill"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Total Hewan</span>
        <span class="info-box-number">{{ $totalPet }}</span>
    </div>
</div>

<div class="info-box mb-3 text-bg-warning">
    <span class="info-box-icon"><i class="bi bi-person-heart"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Pemilik Terdaftar</span>
        <span class="info-box-number">{{ $totalPemilik }}</span>
    </div>
</div>

<div class="info-box mb-3 text-bg-success">
    <span class="info-box-icon"><i class="bi bi-journal-text"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Total Rekam Medis</span>
        <span class="info-box-number">{{ $totalRekamMedis }}</span>
    </div>
</div>

<div class="info-box mb-3 text-bg-danger">
    <span class="info-box-icon"><i class="bi bi-list-ol"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Antrian Hari Ini</span>
        <span class="info-box-number">{{ $antrianHariIni->count() }}</span>
    </div>
</div>
