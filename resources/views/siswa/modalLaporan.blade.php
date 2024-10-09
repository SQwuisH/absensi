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
                    <div class="row g-2 mb-2">
                        <div class="col mb-0">
                            <label for="masuk" class="form-label">Foto Masuk</label>
                            <div id="masuk">
                                <img
                                    style="max-height: 300px"src={{ asset('storage/uploads/absensi/' . $a->foto_masuk) }}>
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="pulang" class="form-label">Foto Pulang</label>
                            <div id="pulang">
                                @if ($a->foto_pulang)
                                    <img
                                        style="max-height: 300px"src={{ asset('storage/uploads/absensi/' . $a->foto_pulang) }}>
                                @elseif($a->status == 'TAP')
                                    <p>Tidak Absen Pulang</p>
                                @else
                                    <p>Belum Absen Pulang</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif ($a->status == 'izin' || $a->status == 'sakit')
                    <div class="row mb-2">

                        <label for="masuk" class="form-label">Foto :</label>
                        <div class="col mb-0 text-center">
                            <div id="masuk">
                                <img
                                    style="max-height: 300px"src={{ asset('storage/uploads/absensi/' . $a->foto_masuk) }}>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="keterangan">Keterangan :</label>
                            <textarea class="form-control" id="keterangan" rows="3" disabled>{{ $a->keterangan }}</textarea>
                        </div>
                    </div>
                @endif
                <div class="row">
                    @switch($a->status)
                        @case('hadir')
                            <div class="col mb-3 badge bg-absen">{{ $a->status }}
                            </div>
                        @break

                        @case('sakit')
                            <div class="col mb-3 badge bg-info">{{ $a->status }}
                            </div>
                        @break

                        @case('izin')
                            <div class="col mb-3 badge bg-warning">{{ $a->status }}
                            </div>
                        @break

                        @case('alfa')
                            <div class="col mb-3 badge bg-danger">{{ $a->status }}
                            </div>
                        @break

                        @case('terlambat')
                            <div class="col mb-3 badge bg-secondary">{{ $a->status }}
                            </div>
                        @break

                        @case('TAP')
                            <div class="col mb-3 badge bg-black">{{ $a->status }}
                            </div>
                        @break
                    @endswitch
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
