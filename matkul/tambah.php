<?php
include('../blok.php');
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

if (isset($_POST['simpan'])) {
    $kodeMatkul = $_POST['kodeMatkul'];
    $namaMatkul = $_POST['namaMatkul'];
    $sks        = $_POST['sks'];
    $nidn       = $_POST['nidn'];

    $cek = mysqli_query($koneksi, "SELECT kodeMatkul FROM tbl_matkul WHERE kodeMatkul = '$kodeMatkul'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Kode Matkul sudah terdaftar');</script>";
    } else {
        $sql = "INSERT INTO tbl_matkul (kodeMatkul, namaMatkul, sks, nidn) VALUES ('$kodeMatkul', '$namaMatkul', '$sks', '$nidn')";
        
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
                <h4 class="mb-0">Form Tambah Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Kode Mata Kuliah</label>
                        <input type="text" name="kodeMatkul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="namaMatkul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>SKS</label>
                        <input type="number" name="sks" class="form-control" min="1" max="6">
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
                    
                    <button type="submit" name="simpan" class="btn btn-success">Simpan Data</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>
