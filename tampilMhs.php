	<?php
		require_once('lib/nusoap.php');
		$c = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
		//siapkan param input
		//eksekusi fungsi ws
		$paramOutput = $c->call('viewMhsSemua');
		//tampilkan hasil
		//print_r($paramOutput);
	?>
<div class="row">
	<div class="col-lg-12">
		<h3>Data Semua Mahasiswa</h3><br>
		<form action="" method="post">
			<table class="table-responsive table">
				<tr>
					<th>No</th>
					<th>NIM</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Prodi</th>
					<th>Aksi</th>
				</tr>
				<?php
					$no = 1;
					for($i=0; $i<count($paramOutput); $i++){
				?>
				<tr>
					<td><?php echo $no++;?></td>
					<td><?php echo $paramOutput[$i]['nim']; ?></td>
					<td><?php echo $paramOutput[$i]['nama']; ?></td>
					<td><?php echo $paramOutput[$i]['alamat']; ?></td>
					<td><?php echo $paramOutput[$i]['prodi']; ?></td>
					<td>
						<a href="index.php?page=editMhs&&nim=<?php echo $paramOutput[$i]['nim']; ?>"><span class="glyphicon glyphicon-pencil"></span></a> 
						<a href="deleteMhs.php?nim=<?php echo $paramOutput[$i]['nim']; ?>"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
		</form>
	</div>
</div>
