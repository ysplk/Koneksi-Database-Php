<?php
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

if (isset($_POST['simpan'])) {
    $nim        = $_POST['nim'];
    $kodeMatkul = $_POST['kodeMatkul'];
    $nidn       = $_POST['nidn'];
    $nilai      = $_POST['nilai'];
    $nilaiHuruf = $_POST['nilaiHuruf'];

    $cek = mysqli_query($koneksi, "SELECT * FROM tbl_nilai WHERE nim = '$nim' AND kodeMatkul = '$kodeMatkul'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Nilai untuk mahasiswa dan matkul ini sudah ada');</script>";
    } else {
        $sql = "INSERT INTO tbl_nilai (nim, kodeMatkul, nidn, nilai, nilaiHuruf) VALUES ('$nim', '$kodeMatkul', '$nidn', '$nilai', '$nilaiHuruf')";
        
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
                <h4 class="mb-0">Form Tambah Nilai Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Mahasiswa</label>
                        <select name="nim" class="form-control" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php
                            $mhs = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa");
                            while ($m = mysqli_fetch_array($mhs)) {
                                echo "<option value='$m[nim]'>$m[nim] - $m[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Mata Kuliah</label>
                        <select name="kodeMatkul" class="form-control" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <?php
                            $matkul = mysqli_query($koneksi, "SELECT * FROM tbl_matkul");
                            while ($mk = mysqli_fetch_array($matkul)) {
                                echo "<option value='$mk[kodeMatkul]'>$mk[kodeMatkul] - $mk[namaMatkul]</option>";
                            }
                            ?>
                        </select>
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

                    <div class="mb-3">
                        <label>Nilai (0-100)</label>
                        <input type="number" name="nilai" class="form-control" min="0" max="100" required>
                    </div>

                    <div class="mb-3">
                        <label>Nilai Huruf</label>
                        <select name="nilaiHuruf" class="form-control" required>
                            <option value="">-- Pilih Grade --</option>
                            <option value="A">A (90-100)</option>
                            <option value="B">B (80-89)</option>
                            <option value="C">C (70-79)</option>
                            <option value="D">D (60-69)</option>
                            <option value="E">E (0-59)</option>
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
