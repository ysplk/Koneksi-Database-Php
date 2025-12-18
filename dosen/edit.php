<?php
include('../blok.php');
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

$nidn = $_GET['nidn'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_dosen WHERE nidn = '$nidn'"));

if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    $sql = "UPDATE tbl_dosen SET nama='$nama', prodi='$prodi', email='$email' WHERE nidn='$nidn'";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diubah'); window.location='/dosen/index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<main>
    <div class="container px-4 mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Edit Data Dosen</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>NIDN</label>
                        <input type="text" class="form-control bg-light" value="<?= $data['nidn'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Nama Dosen</label>
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
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include('../componen/footer.php'); ?>