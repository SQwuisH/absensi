@if ($statusabsen == 'belum presensi' || $statusabsen == 'izin' || $statusabsen == 'sakit' || $statusabsen == 'terlambat')
    @if ($statusabsen == 'terlambat' && date('Hi') > $waktu->mulai_pulang)
        <div class="col">
            <div class="card mb-4 border border-warning">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center ">
                    <h2 class="bg-label-warning">Belum Absen Pulang</h2>
                </div>
            </div>
        </div>
    @else
        <div class="col">
            <div class="card mb-4 border border-warning">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center ">
                    <h2 class="bg-label-warning">{{ $statusabsen }}</h2>
                </div>
            </div>
        </div>
    @endif
@elseif ($statusabsen == 'hadir')
    @if (date('Hi') > $waktu->mulai_pulang)
        <div class="col">
            <div class="card mb-4 border border-warning">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center ">
                    <h2 class="bg-label-warning">Belum Absen Pulang</h2>
                </div>
            </div>
        </div>
    @else
        <div class="col">
            <div class="card mb-4 border border-absen">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center ">
                    <h2 class="bg-label-absen">{{ $statusabsen }}</h2>
                </div>
            </div>
        </div>
    @endif
@elseif ($statusabsen == 'TAP')
    <div class="col">
        <div class="card mb-4 border border-danger">
            <div class="card-header">
                <h4 class="card-title">
                    Status
                </h4>
            </div>
            <div class="card-body d-flex justify-content-center text-center ">
                <h2 class="bg-label-danger">{{ $statusabsen }}</h2>
            </div>
        </div>
    </div>
@endif
