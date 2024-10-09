{{-- edit --}}
<form action="{{route('editkesiswaan')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" hidden value="{{ $k->id }}">
    <div class="modal fade" id="edit{{ $k->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit kesiswaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Nama</label>
                            <input name="name" type="text" id="nameBasic" class="form-control"
                                value=" @php echo($k->name); @endphp " required>
                        </div>
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Email</label>
                            <input name="email" type="email" id="nameBasic" class="form-control"
                                placeholder="Masukkan Nama" required value="{{ $k->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">password</label>
                            <input name="password" type="text" id="nameBasic" class="form-control"
                                placeholder="Default Password '12345678'">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-absen">Simpan</button>
                    </div>
                </div>
            </div>
        </div></div>
</form>


{{-- Hapus --}}

<form action= {{ route('deletekesiswaan', ['id' => $k->id]) }} method="post">
    @csrf
    @method('delete')
    <div class="modal fade" id="hapus{{ $k->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Hapus Data kesiswaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Peringatan Data <i><b> {{ $k->name }} </b></i> Akan Dihapus Secara
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
