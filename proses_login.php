<?php
// mulai sesi
session_start();

include 'componen/database.php';

// Cek darurat biar lu tau kalo file koneksi kaga ketemu
if (!isset($koneksi)) {
    die("Error: File koneksi tidak ketemu di 'componen/database.php' atau variabel \$koneksi tidak ada. !");
}

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

//melakukan pengecekan pada database
$query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    // melakukan pengecekan passwd dan username
    if ($password == $data['password']) {

        $_SESSION['username'] = $username;
        $_SESSION['role']     = $data['role'];
        $_SESSION['nama']     = $data['nama_lengkap'];
        $_SESSION['status']   = "login";

        // redirek ke halaman dashboard 
        header("location:index.php");
    } else {
        header("location:login.php?pesan=gagal");
    }
} else {
    //pesan gagal login
    header("location:login.php?pesan=gagal");
}
