<?php
include('../blok.php');
include('../componen/database.php');

$kodeMatkul = $_GET['kodeMatkul'];
$sql = "DELETE FROM tbl_matkul WHERE kodeMatkul = '$kodeMatkul'";
mysqli_query($koneksi, $sql);
header("Location: index.php");
exit;
?>
