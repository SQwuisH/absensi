{{-- edit --}}
<form action="/editwalikelas" method="post" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="edit{{$w->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Wali Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">



            <div class="row">
                <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Nama</label>
                    <input name="name" type="text" id="nameBasic" class="form-control" value=" @php echo($w->name); @endphp " required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="nameBasic" class="form-label">password</label>
                    <input name="password" type="text" id="nameBasic" class="form-control" placeholder="Default Password '12345678'">
                </div>
            </div>
        <div class="row">
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">NUPTK</label>
                <input name="nuptk" type="text" id="nameBasic" class="form-control" value="@php echo($w->nuptk); @endphp" required>
            </div>
            <div class="col mb-3">
                <label for="nameBasic" class="form-label">NIP</label>
                <input name="nip" type="text" id="nameBasic" class="form-control" value="@php echo($w->nip); @endphp" required>
            </div>
        </div>
          <div class="row">
            <div class="col mb-3">
              <label for="emailBasic" class="form-label">Email</label>
              <input name="email" type="email" id="emailBasic" class="form-control" value="@php echo($w->email); @endphp" required>
            </div>
            <div class="col mb-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jk" class="form-select form-control">
                <option selected hidden>Pilih</option>
                <option value="1">laki laki</option>
                <option value="2">perempuan</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
      </div>
    </div>
</div>
</form>
