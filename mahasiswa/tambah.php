<?php
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

if (isset($_POST['simpan'])) {
    $nim      = $_POST['nim'];
    $nama     = $_POST['nama'];
    $prodi    = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];
    $email    = $_POST['email'];

    $cek_nim = mysqli_query($koneksi, "SELECT nim FROM tbl_mahasiswa WHERE nim = '$nim'");
    
    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>alert('NIM sudah terdaftar');</script>";
    } else {
        $sql = "INSERT INTO tbl_mahasiswa VALUES ('$nim', '$nama', '$prodi', '$angkatan', '$email')";
        
        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Data berhasil disimpan'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data');</script>";
        }
    }
}
?>

<main>
    <div class="container px-4 mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white text-center">
                <h4 class="mb-0">Form Tambah Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Program Studi</label>
                        <select name="prodi" class="form-control" required>
                            <option value=""> Pilih Prodi </option>
                            <option value="Teknologi Rekayasa Perangkat Lunak">Teknologi Rekayasa Perangkat Lunak</option>
                            <option value="Teknologi Rekayasa Manufaktur">Teknologi Rekayasa Manufaktur</option>
                            <option value="Teknologi Rekayasa Mekatronika">Teknologi Rekayasa Mekatronika</option>
                            <option value="Teknologi Listrik">Teknologi Listrik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    
                    <button type="submit" name="simpan" class="btn btn-success">Simpan Data</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>