{{-- edit --}}
<form action="{{ route('editwalisiswa') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" hidden value="{{ $w->id_user }}">
    <div class="modal fade" id="edit{{ $w->id_user }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Wali Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Nama</label>
                            <input name="name" type="text" id="nameBasic" class="form-control"
                                value=" @php echo($w->user->name); @endphp " required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">password</label>
                            <input name="password" type="text" id="nameBasic" class="form-control"
                                placeholder="Default Password '12345678'">
                        </div>
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">NIK</label>
                            <input name="nik" type="text" id="nameBasic" class="form-control"
                                value="@php echo($w->nik); @endphp" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input name="alamat" type="text" id="alamat" class="form-control" value="{{ $w->alamat}}" placeholder="Masukkan Alamat Wali Siswa" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="emailBasic" class="form-label">Email</label>
                            <input name="email" type="email" id="emailBasic" class="form-control"
                                value="@php echo($w->user->email); @endphp" required>
                        </div>
                        <div class="col mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jk" class="form-select form-control" required>
                                <option value="{{ $w->jenis_kelamin }}" hidden>{{ $w->jenis_kelamin }}</option>
                                <option value="1">laki laki</option>
                                <option value="2">perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-absen">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Hapus --}}

<form action="{{ route('deletewalisiswa', ['id' => $w->id_user]) }}" method="post">
    @csrf
    @method('delete')
    <div class="modal fade" id="hapus{{ $w->id_user }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Hapus Data Wali Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Peringatan Data <i><b> {{ $w->user->name }} </b></i> Akan Dihapus Secara
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
