<?php
$host = 'localhost';
$user = 'root';
$pass = '123';
$port = '3307';
$db   = 'kampus';

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>