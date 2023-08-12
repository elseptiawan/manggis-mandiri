<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="container-fluid p-0">
        @if(session()->has('error'))
        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h3 mb-3">Barang</h1>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $(document).ready(function() {
            read();
        });
        // Read Database
        function read() {
            $.get("{{ url('barang/read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        function create() {
            $.get("{{ url('barang/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Tambah Data Barang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
        // untuk proses create data
        function store() {
            var nama_barang = $("#nama_barang").val();
            var harga_beli = $("#harga_beli").val();
            var harga_jual = $("#harga_jual").val();
            var jumlah = $("#jumlah").val();
            var satuan = $("#satuan").val();
            var status = $("#status").val();
            $.ajax({
                url: "{{ url('barang/store') }}",
                type: "post",
                data: {
                    _token: $("#csrf").val(),
                    nama_barang: nama_barang, 
                    harga_beli: harga_beli,
                    harga_jual: harga_jual,
                    jumlah: jumlah,
                    satuan: satuan,
                    status: status,
                },
                success: function(data) {
                    $(".btn-close").click();
                    read();
                }
            });
        }

        // Untuk modal halaman edit show
        function edit(id) {
            $.get("{{ url('barang/edit') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Barang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        // untuk proses update data
        function update(id) {
            var nama_barang = $("#nama_barang").val();
            var harga_beli = $("#harga_beli").val();
            var harga_jual = $("#harga_jual").val();
            var jumlah = $("#jumlah").val();
            var satuan = $("#satuan").val();
            var status = $("#status").val();
            $.ajax({
                type: "put",
                url: "{{ url('barang/update') }}/" + id,
                data: {
                    _token: $("#csrf").val(),
                    nama_barang: nama_barang, 
                    harga_beli: harga_beli,
                    harga_jual: harga_jual,
                    jumlah: jumlah,
                    satuan: satuan,
                    status: status,
                },
                success: function(data) {
                    $(".btn-close").click();
                    read()
                }
            });
        }

        // untuk delete atau destroy data
        function destroy(id) {
            $.ajax({
                type: "delete",
                url: "{{ url('barang/destroy') }}/" + id,
                data: {
                    _token: $("#csrf").val()
                },
                success: function(data) {
                    $(".btn-close").click();
                    read()
                }
            });
        }
    </script>
@endsection