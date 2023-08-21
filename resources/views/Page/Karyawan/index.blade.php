<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="container-fluid p-0">
        @if(session()->has('error'))
        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h3 mb-3">Karyawan</h1>
            <button class="btn btn-outline-primary" onClick="create()">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data</button>
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
        function read() {
            $.get("{{ url('karyawan/read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        function create() {
            $.get("{{ url('karyawan/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Tambah Data Karyawan')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
        // untuk proses create data
        function store() {
            var nama_karyawan = $("#nama_karyawan").val();
            var posisi = $("#posisi").val();
            var no_hp = $("#no_hp").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirm_password = $("#confirm_password").val();
            $.ajax({
                url: "{{ url('karyawan/store') }}",
                type: "post",
                data: {
                    _token: $("#csrf").val(),
                    nama_karyawan: nama_karyawan, 
                    posisi: posisi,
                    no_hp: no_hp,
                    email: email,
                    password: password,
                    confirm_password: confirm_password,
                },
                success: function(data) {
                    $(".btn-close").click();
                    read();
                }
            });
        }

        // Untuk modal halaman edit show
        function edit(id) {
            $.get("{{ url('karyawan/edit') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Data Karyawan')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        // untuk proses update data
        function update(id) {
            var nama_pelanggan = $("#nama_pelanggan").val();
            var alamat = $("#alamat").val();
            var no_hp = $("#no_hp").val();
            $.ajax({
                type: "put",
                url: "{{ url('pelanggan/update') }}/" + id,
                data: {
                    _token: $("#csrf").val(),
                    nama_pelanggan: nama_pelanggan, 
                    alamat: alamat,
                    no_hp: no_hp,
                },
                success: function(data) {
                    $(".btn-close").click();
                    read()
                }
            });
        }

        // untuk delete atau destroy data
        function destroy(id) {
            if(confirm('Yakin Ingin Menghapus Data?')){
                $.ajax({
                    type: "delete",
                    url: "{{ url('karyawan/destroy') }}/" + id,
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