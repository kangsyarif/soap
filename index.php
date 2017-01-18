<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Belajar SOAP</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Belajar SOAP</a>
		</div>

		
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
                    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="index.php?page=tampilMhs"><i class="fa fa-fw fa-book"></i> Data Mahasiswa</a>
                </li>
				<li>
                    <a href="index.php?page=inputMhs"><i class="fa fa-fw fa-book"></i> Tambah Data</a>
                </li>
                <li>
                    <a href="index.php?page=cariNIM"><i class="fa fa-fw fa-th-large"></i> Pencarian NIM</a>
                </li>
				<li>
                    <a href="index.php?page=cariProdi"><i class="fa fa-fw fa-th-large"></i> Pencarian Prodi</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
  
<div class="container">
	<?php  include "menu.php";	?>
	<br><br>
	<div class="row">
		<div class="col-md-12">	
			<ol class="breadcrumb">
				<footer class="text-center">&copy; Syarif Hidayatulloh - 2017</footer>
			</ol>
		</div>
	</div>
</div>

<script src="assets/js/jquery-3.1.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>