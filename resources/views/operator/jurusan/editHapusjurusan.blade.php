{{-- edit --}}
<form action="{{route('editjurusan')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" hidden value="{{ $w->id_jurusan }}">
    <div class="modal fade" id="edit{{ $w->id_jurusan }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Nama Jurusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">ID Jurusan</label>
                            <input name="id_jurusan" type="text" id="nameBasic" class="form-control"
                                value=" @php echo($w->id_jurusan); @endphp " required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Nama Jurusan</label>
                            <input name="nama_jurusan" type="text" id="nameBasic" class="form-control"
                                value=" @php echo($w->nama_jurusan); @endphp " required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-absen">Simpan</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</form>

{{-- Hapus --}}
<form action="{{ route('deletejurusan', ['id' => $w->id_jurusan]) }}" method="post">
    @csrf
    @method('delete')
    <div class="modal fade" id="hapus{{ $w->id_jurusan }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Hapus Data Wali Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Peringatan Data <i><b> {{ $w->nama_jurusan }} </b></i> Akan Dihapus Secara
                    Permanen!</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batalkan
                    </button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
