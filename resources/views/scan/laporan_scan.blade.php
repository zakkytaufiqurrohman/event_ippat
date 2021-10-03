<!DOCTYPE html>
<html>
<head>
	<title>Laporan Scan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<center>
			<h4>Laporan Scan Ke - {{$scan}}</h4>
		</center>
		<br/>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Pengda</th>
					<th>Nama</th>
					<th>Kode</th>
					<th>Sk</th>
					<th>Jam</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($datas as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{  $p->pengda}}</td>
					<td>{{ \Crypt::decryptString($p->nama)}}</td>
					<td>{{ $p->kode}}</td>
					<td>{{ \Crypt::decryptString($p->no_sk)}}</td>
					<td>{{ $p->jam}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</body>
</html>