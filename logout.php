<?php
// memulai sesi  suapaya tau yang logout
session_start();
// mengosongkan sesi
session_destroy();
// kembali ke halaman login
header("location:login.php");
?>