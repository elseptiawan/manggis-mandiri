<!DOCTYPE html>
<html>
<head>
	<title>Nota Penjualan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
        table.table-bordered > thead > tr > th{
            border:1px solid black;
        }
        table.table-bordered > tbody > tr > th{
            border:1px solid black;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid black;
        }
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 
    <h4>Nota Penjualan {{ \Carbon\Carbon::parse($penjualan->created_at)->translatedFormat('l, d F Y') }}</h4>
    <h6>Pelanggan : {{ $penjualan->pelanggan->nama_pelanggan }}</h6>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Banyak Barang</th>
				<th>Nama Barang</th>
				<th>Harga</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			{{-- @php $i=1 @endphp --}}
			@foreach($penjualan->barang as $barang)
			<tr>
				<td>{{$barang->jumlah}} {{ $barang->satuan }}</td>
				<td>{{$barang->nama_barang}}</td>
				<td>Rp. {{$barang->harga_jual}}</td>
				<td>Rp. {{$barang->harga_jual * $barang->jumlah}}</td>
			</tr>
			@endforeach
            <tr>
                <td style="border-right: none"></td>
                <td style="border-left: none; border-rigth: none;"></td>
                <th style="border-left: none">Total Harga</th>
                <td>Rp. {{ $harga_total }}</td>
            </tr>
            <tr>
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
            </tr>
		</tbody>
	</table>
 
</body>
</html>