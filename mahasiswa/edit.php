<?php
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

$nim = $_GET['nim'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE nim = '$nim'"));

if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $prodi    = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];
    $email    = $_POST['email'];

    $sql = "UPDATE tbl_mahasiswa SET nama='$nama', prodi='$prodi', angkatan='$angkatan', email='$email' WHERE nim='$nim'";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data Berhasil Diubah!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal Update!');</script>";
    }
}
?>

<main>
    <div class="container px-4 mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Edit Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control bg-light" value="<?= $data['nim'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
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
                        <input type="number" name="angkatan" class="form-control" value="<?= $data['angkatan'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
                    </div>
                    
                    <button type="submit" name="update" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>