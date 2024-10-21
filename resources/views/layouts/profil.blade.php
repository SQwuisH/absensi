@php
if ($user->nis != null) {
    $title =  "NIS";
    $id = $user->nis;
}elseif ($user->nip != null) {
    $title = "NIP";
    $id = $user->nip;
}elseif ($user->nik != null) {
    $title = "NIK";
    $id = $user->nik;
}

@endphp
<h4 class="card-title mb-2">
    <a href={{url()->previous()}} class="btn rounded btn-outline-danger"><i class='bx bx-chevron-left'></i></a>
    Profil
</h4>
<div class="row mb-2">
    <div class="col">
        <div class="card">
            <div class="card-body row">
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('/storage/user_avatar/' . $user->user->foto) }}" alt=""
                        class="d-block rounded" height="100" width="100">
                </div>
                <div class="col">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="Nama" class="form-label">Nama Panjang</label>
                            <input class="form-control" type="text" id="Nama" value="{{ $user->user->name }}"
                                disabled>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="id" class="form-label">{{$title}}</label>
                            <input class="form-control" type="text" id="NIS" value="00{{ $id }}"
                                disabled>
                            <input type="hidden" name="nis" value="00{{ $id }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Email" class="form-label">Email</label>
                            <input disabled class="form-control" type="Email" id="Email" name="email"
                                value="{{ $user->user->email }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
