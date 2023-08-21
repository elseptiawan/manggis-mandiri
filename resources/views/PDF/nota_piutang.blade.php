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
 
    <h4>Nota Piutang {{ \Carbon\Carbon::parse($piutang->created_at)->translatedFormat('l, d F Y') }}</h4>
    <h6>Pelanggan : {{ $piutang->pelanggan->nama_pelanggan }}</h6>
	<table class='table table-bordered'>
		<tbody>
			<tr>
				<th>Setoran</th>
				<td>Rp. {{$piutang->setoran}}</td>
			</tr>
            <tr>
				<th>Pinjaman</th>
				<td>Rp. {{$piutang->hutang}}</td>
			</tr>
		</tbody>
	</table>
 
</body>
</html>