<!-- Modal -->
<div class="modal fade" id="modal{{ $a->id_absensi }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Detil Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($a->status == 'hadir' || $a->status == 'terlambat' || $a->status == 'TAP')
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center">
                            <h6>Foto Masuk : </h6>
                            <img src="{{ asset('storage/uploads/absensi/' . $a->foto_masuk) }}" alt="Foto_Masuk" class="mb-3">
                            <div class="mb-3 badge bg-absen d-block d-md-none">
                                {{ $a->jam_masuk ? $a->jam_masuk : ' - ' }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <h6>Foto Pulang : </h6>
                            <img src="{{ asset('storage/uploads/absensi/' . $a->foto_pulang) }}" alt="Foto_Pulang" class="mb-3">
                            <div class="mb-3 badge bg-absen d-block d-md-none">
                                {{ $a->jam_pulang ? $a->jam_pulang : ' - ' }}
                            </div>
                        </div>
                    </div>
                @elseif ($a->status == 'izin')
                    <div class="mb-3 badge bg-warning">{{ $a->status }}
                    </div>
                @elseif ($a->status == 'sakit')
                    <div class="mb-3 badge bg-info">{{ $a->status }}
                    </div>
                @else
                    <div class="row">
                    </div>
                @endif

            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
