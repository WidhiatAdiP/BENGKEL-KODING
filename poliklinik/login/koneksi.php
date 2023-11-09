<?php 
$databaseHost = 'localhost';
$databaseName = 'poliklinik';
$databaseUsername = 'root';
$databasePassword = '';
 
$koneksi = mysqli_connect($databaseHost, 
    $databaseUsername, $databasePassword, $databaseName);

    if(!$koneksi){
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
?>
