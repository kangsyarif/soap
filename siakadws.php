<?php
require_once('lib/nusoap.php');

$server = new nusoap_server;

$server->configureWSDL('Siakad','http://siakad.sinus.ac.id/ws');

//menambahkan tipe komplek record mahasiswa
$server->wsdl->addComplexType(
	'Mahasiswa',		//nama tipe
	'complexTime',		//jenis tipe
	'struct',			//tipe data php; struct|array
	'sequence',			//compositor: all|sequence|choice
	'',					//kosong->untuk array saja
	array(				//detil deskripsi field penyusun
		'nim'=>array('name'=>'nim', 'type'=>'xsd:string'),
		'nama'=>array('name'=>'nama', 'type'=>'xsd:string'),
		'alamat'=>array('name'=>'alamat', 'type'=>'xsd:string'),//ini saya tambahkan karena field pd database jg saya tambah
		'prodi'=>array('name'=>'prodi', 'type'=>'xsd:string')
	)
);
//menambahkan tipe komplek array of record mahasiswa
$server->wsdl->addComplexType(
	'ArrayMahasiswa',	//nama tipe
	'complexType',		//jenis tipe
	'array',			//tipe data php; struct|array
	'',					//kosong->compositor: all|sequence|choice
	'http://schemas.xmlsoap.org/soap/encoding/:Array',	//Encoding untuk array
	array(),
	array(
		array('ref'=>'SOAP-ENC:arrayType',
				'wsdl:arrayType'=>'tns:Mahasiswa[]')
	),
	'tns:Mahasiswa'
);

$server->register('InputMhs', //nama fungsi
					array('nomhs'=>'xsd:string',
						  'nmmhs'=>'xsd:string',
						  'alamat'=>'xsd:string',	//ini saya tambahkan karena field pd database jg saya tambah
						  'prodi'=>'xsd:string'), //input
					array('pesan'=>'csd:string'), //output
					'http://siakad.sinus.ac.id/ws'); //namespace
					
$server->register('UpdateMhs', //nama fungsi
					array('nomhs'=>'xsd:string',
						  'nmbaru'=>'xsd:string',
						  'almtbaru'=>'xsd:string', //ini saya tambahkan karena field pd database jg saya tambah
						  'pbaru'=>'xsd:string'), //input
					array('pesan'=>'csd:string'), //output
					'http://siakad.sinus.ac.id/ws'); //namespace

$server->register('DeleteMhs', //nama fungsi
					array('nomhs'=>'xsd:string'), //input
					array('pesan'=>'csd:string'), //output
					'http://siakad.sinus.ac.id/ws'); //namespace

$pesan = '';

$server->register('viewMhs', //nama fungsi
					array('nim'=>'xsd:string'), //input
					array('mhs'=>'tns:Mahasiswa'), //output
					'http://siakad.sinus.ac.id/ws'); //namespace

$server->register('viewMhsPerProdi', //nama fungsi
					array('prodi'=>'xsd:string'), //input
					array('listmhs'=>'tns:ArrayMahasiswa'), //par. output
					'http://siakad.sinus.ac.id/ws'); //namespace

$server->register('viewMhsSemua', //nama fungsi
					array('prodi'=>'xsd:string'), //input
					array('listmhs'=>'tns:ArrayMahasiswa'), //par. output
					'http://siakad.sinus.ac.id/ws'); //namespace
					
function viewMhsPerProdi($prodi){
	$cn 	= mysql_connect('localhost','root','');
	mysql_select_db('akademik', $cn);
	$sql 	= "SELECT nim, nama, alamat, prodi FROM mhs WHERE prodi='$prodi'";
	$hasil 	= mysql_query($sql, $cn);
	while($baris = mysql_fetch_array($hasil)){
		$listmhs[] 	= array(
						'nim'=>$baris['nim'],
						'nama'=>$baris['nama'],
						'alamat'=>$baris['alamat'],
						'prodi'=>$baris['prodi'],
					);
	}
	return $listmhs;
}

function viewMhsSemua(){
	$cn 	= mysql_connect('localhost','root','');
	mysql_select_db('akademik', $cn);
	$sql 	= "SELECT nim, nama, alamat, prodi FROM mhs ";
	$hasil 	= mysql_query($sql, $cn);
	while($baris = mysql_fetch_array($hasil)){
		$listmhs[] 	= array(
						'nim'=>$baris['nim'],
						'nama'=>$baris['nama'],
						'alamat'=>$baris['alamat'],
						'prodi'=>$baris['prodi'],
					);
	}
	return $listmhs;
}

function viewMhs($nim){
	$cn = mysql_connect('localhost','root','');
	mysql_select_db('akademik', $cn);
	$sql = "SELECT nim,nama,alamat,prodi FROM mhs WHERE nim='$nim' ";
	$hasil = mysql_query($sql, $cn);
	$baris = mysql_fetch_array($hasil);
	$mhs = array(
				'nim'=>$baris['nim'],
				'nama'=>$baris['nama'],	
				'alamat'=>$baris['alamat'],	//ini saya tambahkan karena field pd database jg saya tambah
				'prodi'=>$baris['prodi'],
			);
	return $mhs;
}

function InputMhs($nomhs,$nmmhs,$alamat,$prodi){

if(!empty($nomhs) && !empty($nmmhs) && !empty($alamat) && !empty($prodi)){
$cn = mysql_connect('localhost','root','');
mysql_select_db('akademik', $cn);
$sql = "INSERT INTO mhs(nim,nama,alamat,prodi)
		VALUES('$nomhs','$nmmhs','$alamat','$prodi') ";
mysql_query($sql,$cn);
	if (mysql_affected_rows($cn)>0)
	$pesan = 'input data mhs berhasil';
	else
	$pesan = 'Input data mhs gagal';
}else{
$pesan = 'Input data siswa tidak valid';
}
return $pesan;
}

function UpdateMhs($nomhs,$nmbaru,$almtbaru,$pbaru){
if(!empty($nomhs) && !empty($nmbaru) && !empty($almtbaru) && !empty($pbaru)){
$cn = mysql_connect('localhost','root','');
mysql_select_db('akademik', $cn);
$sql = "UPDATE mhs
		SET nama='$nmbaru', alamat='$almtbaru', prodi='$pbaru'
		WHERE nim='$nomhs' ";
mysql_query($sql,$cn);
	if (mysql_affected_rows($cn)>0)
	$pesan = 'update data mhs berhasil';
	else
	$pesan = 'update data mhs gagal';
}else{
$pesan = 'Update data siswa tidak valid';
}
return $pesan;
}


function DeleteMhs($nomhs){
if(!empty($nomhs)){
$cn = mysql_connect('localhost','root','');
mysql_select_db('akademik', $cn);
$sql = "DELETE FROM mhs
		WHERE nim='$nomhs' ";
mysql_query($sql,$cn);
	if (mysql_affected_rows($cn)>0)
	$pesan = 'Delete data mhs berhasil';
	else
	$pesan = 'Delete data mhs gagal';
}else{
$pesan = 'Delete data siswa tidak valid';
}
return $pesan;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:
'';
$server ->service($HTTP_RAW_POST_DATA);
?>
