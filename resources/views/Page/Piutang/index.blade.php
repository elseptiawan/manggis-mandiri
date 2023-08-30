<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="container-fluid p-0">
        @if(session()->has('error'))
        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h3 mb-3">Piutang</h1>
            @if(auth()->user()->role != "pelanggan")
            <button class="btn btn-outline-primary" onClick="create()">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data
            </button>
            @endif
        </div>
        <div class="row" id="read"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            read();
        });
        // Read Database
        function getSisaHutang(id) {
            $.get("{{ url('piutang/get-sisa-hutang') }}/" + id, {}, function(data, status) {
                // $("#sisaHutang").text(data.sisa_hutang);
                $("#sisaHutang").html(`<label for="sisa_hutang">Sisa Hutang</label>
            <input type='text' id="sisa_hutang" class="form-control mb-3" value=" ${data.sisa_hutang}" readonly/>
            <label for="sisa_saldo">Sisa Saldo</label>
            <input type='text' id="sisa_saldo" class="form-control mb-3" value=" ${data.sisa_saldo}" readonly/>`)
            
            });
        }
        function read() {
            $.get("{{ url('piutang/read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        function create() {
            $.get("{{ url('piutang/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Tambah Data Piutang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
                $('#tanggal').datepicker({
                    format: 'dd-mm-yyyy  '
                });
            });
        }
        // untuk proses create data
        function store() {
            var pelanggan_id = $("#pelanggan_id").val();
            var setoran = $("#setoran").val();
            var hutang = $("#hutang").val();
            var keterangan = $("#keterangan").val();
            var tanggal = $("#tanggal").val();
            var fd = new FormData();

            fd.append('_token',$("#csrf").val());
            fd.append('pelanggan_id', pelanggan_id);
            fd.append('setoran', setoran);
            fd.append('hutang', hutang);
            fd.append('keterangan', keterangan);
            fd.append('tanggal', tanggal);
            $.ajax({
                url: "{{ url('piutang/store') }}",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $(".btn-close").click();
                    read();
                }
            });
            $(".btn-close").click();
            read();
        }

        // Untuk modal halaman edit show
        function edit(id) {
            $.get("{{ url('piutang/edit') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Data Piutang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
                $('#tanggal').datepicker({
                    format: 'dd-mm-yyyy  '
                });
            });
        }

        // untuk proses update data
        function update(id) {
            var pelanggan_id = $("#pelanggan_id").val();
            var setoran = $("#setoran").val();
            var hutang = $("#hutang").val();
            var tanggal = $("#tanggal").val();
            var keterangan = $("#keterangan").val();
            var fd = new FormData();

            fd.append('_token',$("#csrf").val());
            fd.append('pelanggan_id', pelanggan_id);
            fd.append('setoran', setoran);
            fd.append('hutang', hutang);
            fd.append('tanggal', tanggal);
            fd.append('keterangan', keterangan);
            $.ajax({
                type: "post",
                url: "{{ url('piutang/update') }}/" + id,
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $(".btn-close").click();
                    read();
                }
            });
            $(".btn-close").click();
            read();
        }

        // untuk delete atau destroy data
        function destroy(id) {
            if(confirm('Yakin Ingin Menghapus Data?')){
                $.ajax({
                    type: "delete",
                    url: "{{ url('piutang/destroy') }}/" + id,
                    data: {
                        _token: $("#csrf").val()
                    },
                    success: function(data) {
                        $(".btn-close").click();
                        read()
                    }
                });
            }
        }
    </script>
@endsection