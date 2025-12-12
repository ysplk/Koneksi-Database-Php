<?php
include('../componen/database.php');

if (!isset($_GET['nidn']) || empty($_GET['nidn'])) {
    header('Location: index.php?status=error&msg=' . urlencode('Mana NIDN-nya woy? Data gak valid!'));
    exit;
}

$nidn = $_GET['nidn'];

$check_sql = "SELECT nidn FROM tbl_nilai WHERE nidn = ? LIMIT 1";
$stmt_check = mysqli_prepare($koneksi, $check_sql);

if (!$stmt_check) {
    die("Query Error (Cek Data): " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt_check, "s", $nidn);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

if (mysqli_stmt_num_rows($stmt_check) > 0) {
    mysqli_stmt_close($stmt_check);
    header('Location: index.php?status=error&msg=' . urlencode('Gagal menghapus data dosen karena masih memiliki nilai mahasiswa..'));
    exit;
}

mysqli_stmt_close($stmt_check);

$sql_delete = "DELETE FROM tbl_dosen WHERE nidn = ?";
$stmt_delete = mysqli_prepare($koneksi, $sql_delete);

if (!$stmt_delete) {
    die("Query Error (Hapus Data): " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt_delete, "s", $nidn);

if (mysqli_stmt_execute($stmt_delete)) {
    header('Location: index.php?status=deleted');
} else {
    header('Location: index.php?status=error&msg=' . urlencode('Gagal ngehapus data : ' . mysqli_error($koneksi)));
}

mysqli_stmt_close($stmt_delete);
exit;
?>