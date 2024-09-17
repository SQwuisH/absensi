@if ($statusabsen == "belum presen" || $statusabsen == 'izin' || $statusabsen == 'sakit' || $statusabsen == 'terlambat')
    @if ($statusabsen == 'terlambat' && date('Hi') > $waktu->mulai_pulang && $absenpulang == false)
        <div class="col">
            <div class="card mb-4 border border-warning">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center">
                    <h2 class="bg-label-warning d-none d-lg-block">Belum Absen Pulang</h2>
                    <h5 class="bg-label-warning d-block d-lg-none d-xl-none">Belum Absen Pulang</h5>
                </div>
            </div>
        </div>
    @elseif ($statusabsen == 'terlambat' && $absenpulang == true)
        <div class="col">
            <div class="card mb-4 border border-absen">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center ">
                    <h2 class="bg-label-absen d-none d-lg-block">Sudah Pulang</h2>
                    <h5 class="bg-label-absen d-block d-lg-none d-xl-none">Sudah Pulang</h5>
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
                <h2 class="bg-label-warning d-none d-lg-block">{{$statusabsen}}</h2>
                <h5 class="bg-label-warning d-block d-lg-none d-xl-none">{{$statusabsen}}</h5>
            </div>
        </div>
    </div>
    @endif
@elseif ($statusabsen == 'hadir')
    @if (date('Hi') < $waktu->mulai_pulang && $absenpulang == null)
        <div class="col">
            <div class="card mb-4 border border-warning">
                <div class="card-header">
                    <h4 class="card-title">
                        Status
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-center text-center ">
                    <h2 class="bg-label-warning d-none d-lg-block">Belum Absen Pulang</h2>
                    <h5 class="bg-label-warning d-block d-lg-none d-xl-none">Belum Absen Pulang</h5>
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
                    <h2 class="bg-label-absen d-none d-lg-block">{{ $statusabsen }}</h2>
                    <h5 class="bg-label-absen d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
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
                <h2 class="bg-label-warning d-none d-lg-block">{{ $statusabsen }}</h2>
                <h5 class="bg-label-warning d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
            </div>
        </div>
    </div>
@endif
