<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
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
		<h5>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Kegiatan</th>
				<th>Deskripsi</th>
				<th>Saran</th>
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