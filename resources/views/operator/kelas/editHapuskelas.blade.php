{{-- edit --}}
<form action="/editkelas" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" hidden value="{{ $w->id_kelas }}">
    <div class="modal fade" id="edit{{ $w->id_kelas }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Wali Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="tingkat" class="form-label">tingkat Kelas</label>
                            <select name="tingkat" id="tingkat" class="form-select">
                                @foreach ($kelas as $k)
                                    <option value={{ $k->tingkat }}> {{ $k->tingkat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="jurusan" class="form-label">jurusan</label>
                            <select name="id_jurusan" id="jurusan" class="form-select">
                                <option value={{ $w->id_jurusan }}> {{ strtoupper($w->id_jurusan) }}</option>
                                @foreach ($jurusan as $j)
                                    <option value={{ $j->id_jurusan }}> {{ strtoupper($j->id_jurusan) }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nomor" class="form-label">Nomor Kelas</label>
                            <input name="nomor_kelas" id="nomor" class="form-control" value={{ $w->nomor_kelas }}
                                placeholder="Masukkan Nomor Kelas">
                            </input>
                        </div>
                        <div class="col mb-3">
                            <label for="wali" class="form-label">Wali Kelas</label>
                            <select name="nuptk" id="wali" class="form-select">
                                @if ($w->user)
                                    <option value={{ $w->nuptk }}> @php echo($w->user->name); @endphp </option>
                                    <option value="">Tanpa Wali Kelas</option>
                                    @foreach ($kosong as $o)
                                        <option value={{ $o->nuptk }}> {{ $o->user->name }}</option>
                                    @endforeach
                                @else
                                    <option value =""> Tanpa Wali Kelas</option>
                                    @foreach ($kosong as $o)
                                        <option value={{ $o->nuptk }}> {{ $o->user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Hapus --}}
<form action="{{ route('hapuskelas', ['id' => $w->id_kelas]) }}" method="post">
    @csrf
    @method('delete')
    <div class="modal fade" id="hapus{{ $w->id_kelas }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Hapus Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Peringatan Data <i><b> @php
                    echo $w->tingkat;
                    echo ' ';
                    echo $w->nama_jurusan;
                    echo ' ';
                    echo $w->nomor_kelas;
                @endphp </b></i> Akan Dihapus Secara Permanen!
                </div>
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
