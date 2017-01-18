<?php
	$nim = $_GET['nim'];
	require_once('lib/nusoap.php');
	
	$c = new nusoap_client('http://localhost/ws/siakadws.php?wsdl', true);
	//siapkan param input
	$paramInput = array('nomhs' => $nim);
	//eksekusi fungsi ws
	$paramOutput = $c->call('DeleteMhs', $paramInput);
	header("Location:index.php?page=tampilMhs");
?>
