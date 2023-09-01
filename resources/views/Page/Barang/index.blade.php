<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="container-fluid p-0">
        @if (session()->has('error'))
            <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h3 mb-3">Barang</h1>
            <button class="btn btn-outline-primary" id="btn-add-data" onClick="create()">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data</button>
        </div>
        <div class="mb-3">
            <button class="btn btn-outline-primary" onClick="event.preventDefault();readbarangmasuk()">Barang Masuk</button>
            <button class="btn btn-outline-primary" onClick="event.preventDefault();readbarangkeluar()">Barang
                Keluar</button>
            <button class="btn btn-outline-primary" onClick="event.preventDefault();readstokbarang()">Stok Barang</button>
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
            readbarangmasuk();
        });

        function onChangeNamaBarang(val) {
            console.log(val);
            if (val == 0) {
                $("#input_nama_barang").html(`<label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2">
            <label for="satuan">Satuan <span style="color: red">*</span></label>
            <input type="text" name="satuan" id="satuan" class="form-control mb-2">`);
            } else {
                $("#input_nama_barang").html('');
            }
        }
        // Read Database
        function readbarangmasuk() {
            $.get("{{ url('barang/read-barang-masuk') }}", {}, function(data, status) {
                $("#btn-add-data").show();
                $("#read").html(data);
            });
        }

        function readbarangkeluar() {
            $.get("{{ url('barang/read-barang-keluar') }}", {}, function(data, status) {
                $("#btn-add-data").hide();
                $("#read").html(data);
            });
        }

        function readstokbarang() {
            $.get("{{ url('barang/read-stok-barang') }}", {}, function(data, status) {
                $("#btn-add-data").hide();
                $("#read").html(data);
            });
        }

        function create() {
            $.get("{{ url('barang/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Tambah Data Barang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
                $('#tanggal').datepicker({
                    format: 'dd-mm-yyyy  '
                });
            });
        }
        // untuk proses create data
        function store() {
            var id_barang = $("#id_barang").val();
            var nama_barang = $("#nama_barang").val();
            var harga_beli = $("#harga_beli").val();
            var harga_jual = $("#harga_jual").val();
            var jumlah = $("#jumlah").val();
            var satuan = $("#satuan").val();
            var status = $("#status").val();
            var tanggal = $("#tanggal").val();
            $.ajax({
                url: "{{ url('barang/store') }}",
                type: "post",
                data: {
                    _token: $("#csrf").val(),
                    id_barang: id_barang,
                    nama_barang: nama_barang,
                    harga_beli: harga_beli,
                    harga_jual: harga_jual,
                    jumlah: jumlah,
                    satuan: satuan,
                    status: status,
                    tanggal: tanggal,
                },
                success: function(data) {
                    $(".btn-close").click();
                    readbarangmasuk();
                }
            });
        }

        // Untuk modal halaman edit show
        function editbarangmasuk(id) {
            $.get("{{ url('barang/edit-barang-masuk') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Barang Masuk')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        // untuk proses update data
        function updatebarangmasuk(id) {
            var nama_barang = $("#nama_barang").val();
            var harga_beli = $("#harga_beli").val();
            var jumlah = $("#jumlah").val();
            $.ajax({
                type: "put",
                url: "{{ url('barang/update-barang-masuk') }}/" + id,
                data: {
                    _token: $("#csrf").val(),
                    nama_barang: nama_barang,
                    harga_beli: harga_beli,
                    jumlah: jumlah,
                },
                success: function(data) {
                    $(".btn-close").click();
                    readbarangmasuk();
                }
            });
        }

        function editstokbarang(id) {
            $.get("{{ url('barang/edit-stok-barang') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Barang')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function updatestokbarang(id) {
            var nama_barang = $("#nama_barang").val();
            var satuan = $("#satuan").val();
            console.log(nama_barang);
            $.ajax({
                type: "put",
                url: "{{ url('barang/update-stok-barang') }}/" + id,
                data: {
                    _token: $("#csrf").val(),
                    nama_barang: nama_barang,
                    satuan: satuan,
                },
                success: function(data) {
                    $(".btn-close").click();
                    readstokbarang();
                }
            });
        }

        // untuk delete atau destroy data
        function destroy(id) {
            if (confirm('Yakin ingin Menghapus Data?')) {
                $.ajax({
                    type: "delete",
                    url: "{{ url('barang/destroy') }}/" + id,
                    data: {
                        _token: $("#csrf").val()
                    },
                    success: function(data) {
                        $(".btn-close").click();
                        readbarangmasuk()
                    }
                });
            }
        }
    </script>
@endsection
