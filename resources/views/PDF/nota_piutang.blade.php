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

    {{-- <div class="header">
    </div> --}}
    <center>
        <h3>TB. Manggis Mandiri</h3>
        <h6>Jalan Lintas Teluk Kuantan - Lubuk Jambi, Desa Koto Kari, Kecamatan Kuantan Tengah</h6>
        <h6>Hp : 082171741021</h6>
    </center>

    <div class="left-header">
        NOTA NO. ........
    </div>
    <div class="right-header">
        <table cellspacing="0">
            <tr>
                <td>{{ \Carbon\Carbon::parse($piutang->tanggal)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>{{ $piutang->pelanggan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td>{{ $piutang->pelanggan->alamat }}</td>
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
            @if ($piutang->setoran > 0)
                <tr>
                    <td></td>
                    <td>Setor Uang Tunai</td>
                    <td></td>
                    <td>Rp. {{ $piutang->setoran }}</td>
                </tr>
            @endif
            @if ($piutang->hutang > 0)
                <tr>
                    <td></td>
                    <td>Pinjam Uang Tunai</td>
                    <td></td>
                    <td>Rp. {{ $piutang->hutang }}</td>
                </tr>
            @endif
            <tr>
                <td style="border-right: none; border-bottom: none; border-left:none"></td>
                <td style="border-left: none; border-rigth: none; border-bottom: none"></td>
                <th>Jumlah</th>
                <td>Rp. {{ $piutang->setoran + $piutang->hutang }}</td>
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
