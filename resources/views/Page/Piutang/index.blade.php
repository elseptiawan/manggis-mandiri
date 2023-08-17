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
            {{-- <button class="btn btn-outline-primary" onClick="create()">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data</button> --}}
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
            $.get("{{ url('piutang/read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        function create() {
            $.get("{{ url('piutang/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Bayar Hutang')
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
            console.log(nama_barang);
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
            $.get("{{ url('piutang/edit') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Bayar Hutang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        // untuk proses update data
        function update(id) {
            var setoran = $("#setoran").val();
            $.ajax({
                type: "put",
                url: "{{ url('piutang/update') }}/" + id,
                data: {
                    _token: $("#csrf").val(),
                    setoran: setoran
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