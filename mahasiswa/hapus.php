<?php
include('../componen/database.php');

if (isset($_GET['nim']) && !empty($_GET['nim'])) {
    $nim = $_GET['nim'];
    
    // Cek apakah mahasiswa memiliki data nilai (Foreign Key)
    $check_sql = "SELECT COUNT(*) as count FROM tbl_nilai WHERE nim = ?";
    $check_stmt = mysqli_prepare($koneksi, $check_sql);
    
    if ($check_stmt) {
        mysqli_stmt_bind_param($check_stmt, "s", $nim);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] > 0) {
            mysqli_stmt_close($check_stmt);
            header("Location: index.php?status=error&msg=" . urlencode('Mahasiswa tidak dapat dihapus karena masih memiliki data nilai'));
        } else {
            mysqli_stmt_close($check_stmt);
            
            // Lakukan penghapusan
            $sql = "DELETE FROM tbl_mahasiswa WHERE nim = ?";
            $stmt = mysqli_prepare($koneksi, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $nim);
                
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
        }
    } else {
        header("Location: index.php?status=error&msg=" . urlencode(mysqli_error($koneksi)));
    }
} else {
    header("Location: index.php?status=error&msg=Data tidak valid");
}
exit;
?>