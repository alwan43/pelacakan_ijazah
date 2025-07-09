<?php
$hostname = "localhost";
$username = "root";
$password = ""; // Ganti jika ada password
$database_name = "pelacakan";

$db = mysqli_connect($hostname, $username, $password, $database_name);

// Cek koneksi
if (!$db) {
    die("Koneksi database rusak: " . mysqli_connect_error());
}
?>
