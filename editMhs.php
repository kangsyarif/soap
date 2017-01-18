<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$nim = $_GET['nim'];
	require_once('lib/nusoap.php');
	
	$c = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
	//siapkan param input
	$paramInput = array('nim' => $nim);
	//eksekusi fungsi ws
	$paramOutput = $c->call('viewMhs', $paramInput);
	
	//proses update ke database
	if(isset($_POST['Update'])){
		//memanggil variable (teksbox)
		$nama	= $_POST['nama'];
		$alamat = $_POST['alamat'];
		$prodi 	= $_POST['prodi'];
		$d = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
		//siapkan param input
		$parameterInput = array('nomhs' => $nim,
								'nmbaru' => $nama,
								'almtbaru' => $alamat,
								'pbaru' => $prodi);
		//eksekusi fungsi ws
		$parameterOutput = $d->call('UpdateMhs', $parameterInput);
		header("Location:index.php?page=tampilMhs");
	}
?>
<div class="row">
	<div class="col-lg-12">
		<h3>Ubah Mahasiswa</h3><br>
		<form action="" method="post">
			<table class="table-responsive table">
				<tr>
					<td>NIM</td>
					<td><input name="nim" type="text" id="nim" class="form-control" value="<?php echo $paramOutput['nim']; ?>" disabled/></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" id="nama" class="form-control" value="<?php echo $paramOutput['nama']; ?>"/></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $paramOutput['alamat']; ?>"/></td>
				</tr>
				<tr>
					<td>Prodi</td>
					<td><input type="text" name="prodi" id="prodi" class="form-control" value="<?php echo $paramOutput['prodi']; ?>"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="Update" class="btn btn-primary" value="Update" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
