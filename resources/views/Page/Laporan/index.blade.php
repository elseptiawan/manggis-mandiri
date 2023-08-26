<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="container-fluid p-0">
        @if(session()->has('error'))
        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-2">
            <h1 id="page-title" class="h3 mb-3">Laporan Piutang</h1>
            {{-- <button class="btn btn-outline-primary" onClick="create()">
                <i class="bi bi-file-earmark-plus"></i> Tambah Data</button> --}}
        </div>
        <div class="mb-3">
            <button class="btn btn-outline-primary" onClick="readpiutang()">Piutang</button>
            <button class="btn btn-outline-primary" onClick="readbarangmasuk()">Barang Masuk</button>
            <button class="btn btn-outline-primary" onClick="readbarangkeluar()">Barang Keluar</button>
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
            readpiutang();
        });
        // Read Database
        function readpiutang() {
            $.get("{{ url('laporan/piutang') }}", {}, function(data, status) {
                $("#page-title").text('Laporan Piutang')
                $("#read").html(data);
            });
        }
        function detailpiutang(id) {
            $.get("{{ url('laporan/piutang') }}/" + id, {}, function(data, status) {
                $("#page-title").text('Detail Piutang')
                $("#read").html(data);
            });
        }
        function rincianhutang(id) {
            $.get("{{ url('laporan/rincian-hutang') }}/" + id, {}, function(data, status) {
                // $("#page-title").text('Detail Piutang')
                // $("#read").html(data);
            });
        }
        function readbarangmasuk() {
            $.get("{{ url('laporan/barang-masuk') }}", {}, function(data, status) {
                $("#page-title").text('Laporan Barang Masuk')
                $("#read").html(data);
            });
        }
        function readbarangkeluar() {
            $.get("{{ url('laporan/barang-keluar') }}", {}, function(data, status) {
                $("#page-title").text('Laporan Barang Keluar')
                $("#read").html(data);
            });
        }
    </script>
@endsection