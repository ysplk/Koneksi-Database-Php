<?php
include('../blok.php');
include('../componen/database.php');

if (isset($_GET['id_nilai']) && !empty($_GET['id_nilai'])) {
    $id = intval($_GET['id_nilai']);
    
    $sql = "DELETE FROM tbl_nilai WHERE id_nilai = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: index.php?status=deleted");
        } else {
            mysqli_stmt_close($stmt);
            header("Location: index.php?status=error&msg=" . urlencode(mysqli_error($koneksi)));
        }
    } else {
        header("Location: index.php?status=error&msg=" . urlencode(mysqli_error($koneksi)));
    }
} else {
    header("Location: index.php?status=error&msg=Data tidak valid");
}
exit;
?>
