<!-- Include DataTables CSS and JS files -->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

{{-- HADIR --}}
<div class="modal fade" id="modalHadir" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalScrollableTitle">List Siswa Hadir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table id="hadir" class="table" style="width: 100%">
                    <thead>
                        <th>NIS</th>
                        <th>Name</th>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#hadir').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dataHadir') }}",
        autoWidth: false,
        columns: [{
                data: 'nis',
                name: 'nis'
            }, // Student ID
            {
                data: 'name',
                name: 'name'
            }, // Student name
        ]
    });
</script>

{{-- SAKIT --}}
<div class="modal fade" id="modalSakit" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalScrollableTitle">List Siswa Sakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table id="sakit" class="table" style="width: 100%">
                    <thead>
                        <th>NIS</th>
                        <th>Name</th>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#sakit').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dataSakit') }}",
        autoWidth: false,
        columns: [{
                data: 'nis',
                name: 'nis'
            }, // Student ID
            {
                data: 'name',
                name: 'name'
            }, // Student name
        ]
    });
</script>


{{-- IZIN --}}
<div class="modal fade" id="modalIzin" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalScrollableTitle">List Siswa Izin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table id="izin" class="table" style="width: 100%">
                    <thead>
                        <th>NIS</th>
                        <th>Name</th>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#izin').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dataIzin') }}",
        autoWidth: false,
        columns: [{
                data: 'nis',
                name: 'nis'
            }, // Student ID
            {
                data: 'name',
                name: 'name'
            }, // Student name
        ]
    });
</script>

{{-- ALFA --}}
<div class="modal fade" id="modalALfa" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalScrollableTitle">List Siswa Alfa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table id="alfa" class="table" style="width: 100%">
                    <thead>
                        <th>NIS</th>
                        <th>Name</th>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#alfa').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dataAlfa') }}",
        autoWidth: false,
        columns: [{
                data: 'nis',
                name: 'nis'
            }, // Student ID
            {
                data: 'name',
                name: 'name'
            }, // Student name
        ]
    });
</script>
