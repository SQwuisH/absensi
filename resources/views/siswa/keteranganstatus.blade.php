@if (
    $statusabsen == 'terlambat' ||
        $statusabsen == 'izin' ||
        $statusabsen == 'belum presen' ||
        $statusabsen == 'belum pulang')
    <div class="col">
        <div class="card mb-4 border border-warning">
            <div class="card-header">
                <h4 class="card-title">
                    Status
                </h4>
            </div>
            <div class="card-body d-flex justify-content-center text-center">
                <h2 class="bg-label-warning d-none d-lg-block">{{ $statusabsen }}</h2>
                <h5 class="bg-label-warning d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
            </div>
        </div>
    </div>
@endif

@if ($statusabsen == 'sakit')
    <div class="col">
        <div class="card mb-4 border border-info">
            <div class="card-header">
                <h4 class="card-title">
                    Status
                </h4>
            </div>
            <div class="card-body d-flex justify-content-center text-center">
                <h2 class="bg-label-info d-none d-lg-block">{{ $statusabsen }}</h2>
                <h5 class="bg-label-info d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
            </div>
        </div>
    </div>
@endif

@if ($statusabsen == 'alfa')
    <div class="col">
        <div class="card mb-4 border border-danger">
            <div class="card-header">
                <h4 class="card-title">
                    Status
                </h4>
            </div>
            <div class="card-body d-flex justify-content-center text-center">
                <h2 class="bg-label-danger d-none d-lg-block">{{ $statusabsen }}</h2>
                <h5 class="bg-label-danger d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
            </div>
        </div>
    </div>
@endif

@if ($statusabsen == 'TAP')
    <div class="col">
        <div class="card mb-4 border border-dark">
            <div class="card-header">
                <h4 class="card-title">
                    Status
                </h4>
            </div>
            <div class="card-body d-flex justify-content-center text-center">
                <h2 class="bg-label-dark d-none d-lg-block">{{ $statusabsen }}</h2>
                <h5 class="bg-label-dark d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
            </div>
        </div>
    </div>
@endif

@if ($statusabsen == 'hadir' || $statusabsen == 'libur')
<div class="col">
    <div class="card mb-4 border border-absen">
        <div class="card-header">
            <h4 class="card-title">
                Status
            </h4>
        </div>
        <div class="card-body d-flex justify-content-center text-center">
            <h2 class="bg-label-absen d-none d-lg-block">{{ $statusabsen }}</h2>
            <h5 class="bg-label-absen d-block d-lg-none d-xl-none">{{ $statusabsen }}</h5>
        </div>
    </div>
</div>
@endif
