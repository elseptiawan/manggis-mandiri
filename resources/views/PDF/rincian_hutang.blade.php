<!DOCTYPE html>
<html>
<head>
	<title>Nota Penjualan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">

		table{
			width: 100%;
			border-collapse: collapse;
		}
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

    <h6>Pelanggan : {{ $piutang[0]->pelanggan->nama_pelanggan }}</h6>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Kredit</th>
				<th>Saldo</th>
			</tr>
		</thead>
		<tbody>
			{{-- @php $i=1 @endphp --}}
            @php
            $i = 1;
            @endphp
			@foreach($piutang as $item)
			<tr>
				<td>{{$i++}}</td>
				<td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
				<td>Rp. {{$item->hutang}}</td>
				<td>Rp. {{$item->setoran}}</td>
			</tr>
			@endforeach
            <tr>
                <td style="border-right: none"></td>
                <td style="border-left: none; border-rigth: none; text-align: right;">Jumlah</td>
                <td style="border-left: none">Rp. {{ $total_hutang }}</td>
                <td>Rp. {{ $total_setoran }}</td>
            </tr>
		</tbody>
	</table>
    @if($total_hutang >= $total_setoran)
    <h6>Sisa Hutang : Rp. {{ $total_hutang - $total_setoran }}</h6>
    @else
    <h6>Sisa Saldo : Rp. {{ $total_setoran - $total_hutang }}</h6>
    @endif
</body>
</html>