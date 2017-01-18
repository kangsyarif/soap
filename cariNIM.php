<?php
	$nim = isset($_POST['nim'])?$_POST['nim']:'';
	require_once('lib/nusoap.php');
	
	$c = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
	//siapkan param input
	$paramInput = array('nim' => $nim);
	//eksekusi fungsi ws
	$paramOutput = $c->call('viewMhs', $paramInput);
	//tampilkan hasil
	//print_r($paramOutput);
?>
<div class="row">
	<div class="col-lg-12">
		<h3>Cari Mahasiswa Berdasarkan NIM</h3><br>	
		<form action="" method="post">
			NIM : 
				<input name="nim" type="text" id="nim" value="<?php echo $paramOutput['nim']; ?>" />
				<input type="submit" name="View" class="btn btn-primary" value="Cari" />
			<br>
			<br>
			<table class="table-responsive table">
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" id="nama" class="form-control" value="<?php echo $paramOutput['nama']; ?>" disabled/></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $paramOutput['alamat']; ?>" disabled/></td>
				</tr>
				<tr>
					<td>Prodi</td>
					<td><input type="text" name="prodi" id="prodi" class="form-control" value="<?php echo $paramOutput['prodi']; ?>" disabled/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
