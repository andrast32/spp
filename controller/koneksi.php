<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "db_spp";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
  die("Koneksi Ke database gagal :" . $mysqli->connect_error);
}
?>