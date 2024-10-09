@if ($statusabsen == 'hadir' || $statusabsen == 'terlambat' || $statusabsen == 'belum waktu presen')
    <div class="row mb-3 text-center">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#izinSakitModal">
            <div class="card-header">
                <h4 class="card-title">
                    Pengajuan
                </h4>
            </div>
        </button>
    </div>
@endif

@if ($statusabsen == 'belum presen' || $statusabsen == 'belum pulang')
    <div class="row mb-2 text-center">
        <a href="{{ route('absen') }}" id="presensi" class="btn btn-absen">
            <div class="card-header">
                <h4 class="card-title">
                    Presensi
                </h4>
            </div>
        </a>
    </div>
    <div class="row mb-3 text-center">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#izinSakitModal">
            <div class="card-header">
                <h4 class="card-title">
                    Pengajuan
                </h4>
            </div>
        </button>
    </div>
@endif
