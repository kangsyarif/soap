<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if(isset($_POST['Simpan'])){
		require_once('lib/nusoap.php');
		$c = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
		//memanggil variabel inputan(texbox)
		$nim	= $_POST['nim'];
		$nama	= $_POST['nama'];
		$alamat	= $_POST['alamat'];
		$prodi	= $_POST['prodi'];
		//siapkan param input
		$paramInput = array('nomhs'=> $nim,
							'nmmhs' => $nama,							
							'alamat' => $alamat,
							'prodi' => $prodi);
		//eksekusi fungsi ws
		$paramOutput = $c->call('InputMhs', $paramInput);
		header("Location:index.php?page=tampilMhs");
	}
?>
<div class="row">
	<div class="col-lg-12">
		<h3>Tambah Mahasiswa</h3><br>
		<form action="" method="post">
			<table class="table-responsive table">
				<tr>
					<td>NIM</td>
					<td><input name="nim" type="text" id="nim" class="form-control" required/></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" id="nama" class="form-control" required/></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" id="alamat" class="form-control" required/></td>
				</tr>
				<tr>
					<td>Prodi</td>
					<td><input type="text" name="prodi" id="prodi" class="form-control" required/></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="Simpan" class="btn btn-primary" value="Simpan"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
