<!DOCTYPE html>
<html>

<head>
    <title>Nota Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.table-bordered>thead>tr>th {
            border: 1px solid black;
        }

        table.table-bordered>tbody>tr>th {
            border: 1px solid black;
        }

        table.table-bordered>tbody>tr>td {
            border: 1px solid black;
        }

        table tr td,
        table tr th {
            font-size: 9pt;
        }

        .table {
            margin-top: 150px;
        }

        .right-header table {
            width: 100%;
        }

        .right-header table tr td {
            border-bottom: 1px solid black;
            text-align: center;
            padding: 10px;
        }

        /* .header{
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border: 2px solid black;
        } */

        .left-header {
            float: left;
            width: 25%;
            margin-top: 90px;
        }

        .right-header {
            float: right;
            text-align: center;
            width: 40%;
        }

        .footer {
            margin-top: 20px;
        }

        .left-footer {
            width: 35%;
            float: left;
            text-align: center;
        }

        .right-footer {
            width: 35%;
            float: right;
            text-align: center;
        }

        center {
            margin-bottom: 10px;
        }
    </style>

    <center>
        <h3 style="margin-bottom: 5px; padding: 0px">TB. Manggis Mandiri</h3>
        <h6 style="margin-bottom: 5px; padding: 0px">Jalan Lintas Teluk Kuantan - Lubuk Jambi, Desa Koto Kari, Kecamatan Kuantan Tengah</h6>
        <h6 style="margin-bottom: 5px; padding: 0px">Hp : 082171741021</h6>
    </center>
    {{-- <div class="header">
    </div> --}}
    <div class="left-header">
        NOTA NO. ........
    </div>
    <div class="right-header">
        <table cellspacing="0">
            <tr>
                <td>{{ \Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>{{ $penjualan->pelanggan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td>{{ $penjualan->pelanggan->alamat }}</td>
            </tr>
        </table>
    </div>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Banyak Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php $i=1 @endphp --}}
            @foreach ($penjualan->barang as $barang)
                <tr>
                    <td>{{ $barang->jumlah }} {{ $barang->stok_barang->satuan }}</td>
                    <td>{{ $barang->stok_barang->nama_barang }}</td>
                    <td>Rp. {{ $barang->harga_jual }}</td>
                    <td>Rp. {{ $barang->harga_jual * $barang->jumlah }}</td>
                </tr>
            @endforeach
            <tr>
                <td style="border-right: none; border-bottom: none; border-left:none"></td>
                <td style="border-left: none; border-rigth: none; border-bottom: none"></td>
                <th>Jumlah</th>
                <td>Rp. {{ $harga_total }}</td>
            </tr>
            {{-- <tr>
                <td style="border-right: none"></td>
                <td style="border-left: none; border-rigth: none;"></td>
                <th style="border-left: none">Dibayar</th>
                <td>Rp. {{ $penjualan->setoran }}</td>
            </tr>
            <tr>
                <td style="border-right: none"></td>
                <td style="border-left: none; border-rigth: none;"></td>
                <th style="border-left: none">Hutang</th>
                <td>Rp. {{ ($harga_total - $penjualan->setoran) > 0 ? ($harga_total - $penjualan->setoran) : 0 }}</td>
            </tr> --}}
        </tbody>
    </table>

    <div class="footer">
        <div class="left-footer">
            Tanda Terima
        </div>
        <div class="right-footer">
            Hormat Kami,
        </div>
    </div>

</body>

</html>
