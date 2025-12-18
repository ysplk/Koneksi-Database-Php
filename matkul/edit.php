<?php
include('../blok.php');
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

$kodeMatkul = $_GET['kodeMatkul'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_matkul WHERE kodeMatkul = '$kodeMatkul'"));

if (isset($_POST['update'])) {
    $namaMatkul = $_POST['namaMatkul'];
    $sks        = $_POST['sks'];
    $nidn       = $_POST['nidn'];

    $sql = "UPDATE tbl_matkul SET namaMatkul='$namaMatkul', sks='$sks', nidn='$nidn' WHERE kodeMatkul='$kodeMatkul'";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diubah'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<main>
    <div class="container px-4 mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Edit Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Kode Mata Kuliah</label>
                        <input type="text" class="form-control bg-light" value="<?= $data['kodeMatkul'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="namaMatkul" class="form-control" value="<?= $data['namaMatkul'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>SKS</label>
                        <input type="number" name="sks" class="form-control" value="<?= $data['sks'] ?>" min="1" max="6">
                    </div>
                    <div class="mb-3">
                            <label>Dosen Pengajar</label>
                            <select name="nidn" class="form-control" required>
                                <option value="">-- Pilih Dosen --</option>
                                <?php
                                $dosen = mysqli_query($koneksi, "SELECT * FROM tbl_dosen");
                                while ($d = mysqli_fetch_array($dosen)) {
                                    echo "<option value='$d[nidn]'>$d[nidn] - $d[nama]</option>";
                                }
                                ?>
                            </select>
                        </div>
        
                    <button type="submit" name="update" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>
