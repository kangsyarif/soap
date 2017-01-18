<?php
	$page = (isset($_GET['page']))? $_GET['page'] : "main";
	switch ($page) {
		case 'home': include "home.php"; break;
		case 'tampilMhs': include "tampilMhs.php"; break;
		case 'inputMhs': include "inputMhs.php"; break;
		case 'editMhs': include "editMhs.php"; break;
		case 'cariProdi': include "cariProdi.php"; break;
		case 'cariNIM': include "cariNIM.php"; break;
		case 'main' :
		default : include 'home.php';	
	}
?>