<?php
$servername = "localhost";
$username = "root";
$password = "zxcv";
$dbName = "SASM";
$conn = new mysqli($servername, $username, $password, $dbName);
mysqli_set_charset($conn, 'utf8');
mysqli_query($conn,"SET NAMES 'utf8'");
if($conn ->connect_error){
	die("CONEXIÓN FALLIDA: " .$conn -> connect_eror);
}
?>