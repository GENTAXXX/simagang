<!DOCTYPE html>
<html>
<head>
	<title>Laporan Logbook Magang</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Logbook Magang</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Tanggal</th>
				<th class="text-center">Kegiatan</th>
				<th class="text-center">Deskripsi</th>
				<th class="text-center">Saran</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1; @endphp
			@foreach($logs as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $p->tanggal }}</td>
				<td>{{ $p->kegiatan }}</td>
				<td>{{ $p->deskripsi_log }}</td>
				<td>{{ $p->saran }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>