<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="container-fluid p-0">
        @if(session()->has('error'))
        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h3 mb-3">Penjualan</h1>
            <button class="btn btn-outline-primary" onClick="create()">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data</button>
        </div>
        <div class="row" id="read"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-75">
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
        var i = 0;
        function addBarang() {
            ++i;
            $("#dynamicAdd").attr("id","hideButton").hide();
            $("#add-input-barang").append(`<div class="d-flex mb-3">
                    <div style="margin-right: 15px" class="w-25">
                        <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
                        <select name="id_barang[${i}]" class="form control form-select form-select-sm mb-2 p-2"
                            aria-label=".form-select-sm example">
                            <option selected disabled hidden>Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-right: 15px" class="w-25">
                        <label for="harga_jual">Harga Jual <span style="color: red">*</span></label>
                        <input type="number" name="harga_jual[${i}]" id="harga_jual" class="form-control mb-2 p-2" required>
                    </div>
                    <div style="margin-right: 15px" class="w-25">
                        <label for="jumlah">Jumlah <span style="color: red">*</span></label>
                        <input type="number" name="jumlah[${i}]" id="jumlah" class="form-control mb-2 p-2" required>
                    </div>
                    <button type="button" name="add" id="dynamicAdd" class="btn btn-outline-primary p-2"
                        style="height: 50%; margin-top: 20px" onClick="addBarang()">Tambah Barang</button>
                </div>`)
        }
        // Read Database
        function read() {
            $.get("{{ url('penjualan/read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        function create() {
            $.get("{{ url('penjualan/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Tambah Data Penjualan')
                $("#page").html(data);
                $("#exampleModal").modal('show');
                $('#tanggal').datepicker({
                    format: 'dd-mm-yyyy  '
                });
            });
            
        }
        // untuk proses create data
        function store() {
            var id_barang = [];
            var harga_jual = [];
            var jumlah = [];
            var i = 1;
            for (let i=0;i<100;i++){
                if(! $(`select[name="id_barang[${i}]"]`).length){
                    break;
                }
                id_barang.push($(`select[name="id_barang[${i}]"]`).val());
                harga_jual.push($(`input[name="harga_jual[${i}]"]`).val());
                jumlah.push($(`input[name="jumlah[${i}]"]`).val());
            }
            var pelanggan_id = $("#pelanggan_id").val();
            var setoran = $("#setoran").val();
            var tanggal = $("#tanggal").val();
            // var nota = $("#nota")[0].files[0];

            var fd = new FormData();

            fd.append('_token',$("#csrf").val());
            fd.append('pelanggan_id', pelanggan_id);
            fd.append('id_barang', id_barang);
            fd.append('harga_jual', harga_jual);
            fd.append('jumlah', jumlah);
            fd.append('setoran', setoran);
            fd.append('tanggal', tanggal);
            // fd.append('nota', nota);
            $.ajax({
                url: "{{ url('penjualan/store') }}",
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
            $.get("{{ url('penjualan/edit') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Data Penjualan')
                $("#page").html(data);
                $("#exampleModal").modal('show');
                $('#tanggal').datepicker({
                    format: 'dd-mm-yyyy  '
                });
            });
        }

        // untuk proses update data
        function update(id) {
            var id_barang = [];
            var harga_jual = [];
            var jumlah = [];
            var i = 1;
            for (let i=0;i<100;i++){
                if(! $(`select[name="id_barang[${i}]"]`).length){
                    break;
                }
                id_barang.push($(`select[name="id_barang[${i}]"]`).val());
                harga_jual.push($(`input[name="harga_jual[${i}]"]`).val());
                jumlah.push($(`input[name="jumlah[${i}]"]`).val());
            }
            var pelanggan_id = $("#pelanggan_id").val();
            var setoran = $("#setoran").val();
            var tanggal = $("#tanggal").val();

            var fd = new FormData();

            fd.append('_token',$("#csrf").val());
            fd.append('pelanggan_id', pelanggan_id);
            fd.append('id_barang', id_barang);
            fd.append('harga_jual', harga_jual);
            fd.append('jumlah', jumlah);
            fd.append('setoran', setoran);
            fd.append('tanggal', tanggal);
            $.ajax({
                type: "post",
                url: "{{ url('penjualan/update') }}/" + id,
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $(".btn-close").click();
                    read()
                }
            });
            $(".btn-close").click();
            read()
        }

        // untuk delete atau destroy data
        function destroy(id) {
            if(confirm('Yakin Ingin Menghapus Data? Data Barang dan Piutang Terkait Penjualan Ini Juga Akan Terhapus!')){
                $.ajax({
                    type: "delete",
                    url: "{{ url('penjualan/destroy') }}/" + id,
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