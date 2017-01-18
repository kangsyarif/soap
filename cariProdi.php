<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$prodi = isset($_POST['prodi'])?$_POST['prodi']:'';
	require_once('lib/nusoap.php');
	
	$c = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
	//siapkan param input
	$paramInput = array('prodi' => $prodi);
	//eksekusi fungsi ws
	$paramOutput = $c->call('viewMhsPerProdi', $paramInput);
	//tampilkan hasil
	//print_r($paramOutput);
?>
<div class="row">
	<div class="col-lg-12">
		<h3>Cari Mahasiswa Per Prodi</h3><br>		
		<form action="" method="post">
			Prodi : <input type="text" name="prodi" id="prodi" value="<?php echo $prodi; ?>"/>
			<input type="submit" name="View" value="Cari" class="btn btn-primary" />
		</form>
		<br />
		<table class="table-responsive table">
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Prodi</th>
			</tr>
			<?php 
				$no = 1;
				if(!empty($paramOutput)){
					for($i=0; $i<count($paramOutput); $i++){
						echo "
							<tr>
							<td>".$no++."</td>
							<td>".$paramOutput[$i]['nim']."</td>
							<td>".$paramOutput[$i]['nama']."</td>
							<td>".$paramOutput[$i]['alamat']."</td>
							<td>".$paramOutput[$i]['prodi']."</td>
						</tr>";
					}
				}else{
					echo "<tr><td colspan='5'>Silahkan Isi Prodi dengan benar dan tekan View</td></tr>";
				}
			?>
		</table>
	</div>
</div>
</body>
</html>
