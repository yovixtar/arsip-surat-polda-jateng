<?php
date_default_timezone_set("Asia/Jakarta");
error_reporting(0);

	$host 	= 'localhost'; // host server
	$user 	= 'root';  // username
	$pass 	= ''; // password user
	$dbname = 'arsip-surat-polda-jateng'; // nama database

	
	// // sesuaikan dengan server anda
	// $host 	= 'localhost'; // host server
	// $user 	= 'iyabosco_polda';  // username 
	// $pass 	= 'ImhWu!?.1L@o'; // password
	// $dbname = 'iyabosco_polda'; // nama database
	
	// Koneksi ke database
	try{
		$config = new PDO("mysql:host=$host;dbname=$dbname;", $user,$pass);
	}catch(PDOException $e){
		echo 'Connection Error : ' .$e->getMessage();
	}
	
	$view = 'app/services/view.php'; // direktori service select data
	$create = 'app/services/create.php'; // direktori service insert data
	$update = 'app/services/update.php'; // direktori service update data
	$delete = 'app/services/delete.php'; // direktori service delete data