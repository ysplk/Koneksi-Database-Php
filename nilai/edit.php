<?php
include('../blok.php');
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');


if (!isset($_GET['id_nilai'])) {
    echo "<script>alert('Akses dilarang! Pilih data dulu dari tabel.'); window.location='index.php';</script>";
    exit;
}

$id_nilai = $_GET['id_nilai'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_nilai WHERE id_nilai = '$id_nilai'");
$data  = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nim        = $_POST['nim'];
    $kodeMatkul = $_POST['kodeMatkul'];
    $nidn       = $_POST['nidn'];
    $nilai      = $_POST['nilai'];
    $nilaiHuruf = $_POST['nilaiHuruf'];

    $sql = "UPDATE tbl_nilai SET nim='$nim', kodeMatkul='$kodeMatkul', nidn='$nidn', nilai='$nilai', nilaiHuruf='$nilaiHuruf' WHERE id_nilai='$id_nilai'";
    
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
                <h4 class="mb-0">Edit Nilai Mahasiswa</h4>
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
                    
                                $selected = ($data['nim'] == $m['nim']) ? 'selected' : '';
                                echo "<option value='$m[nim]' $selected>$m[nim] - $m[nama]</option>";
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
                                $selected = ($data['kodeMatkul'] == $mk['kodeMatkul']) ? 'selected' : '';
                                echo "<option value='$mk[kodeMatkul]' $selected>$mk[kodeMatkul] - $mk[namaMatkul]</option>";
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
                                $selected = ($data['nidn'] == $d['nidn']) ? 'selected' : '';
                                echo "<option value='$d[nidn]' $selected>$d[nidn] - $d[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Nilai (0-100)</label>
                        <input type="number" name="nilai" class="form-control" min="0" max="100" value="<?= $data['nilai'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Nilai Huruf</label>
                        <select name="nilaiHuruf" class="form-control" required>
                            <option value="">-- Pilih Grade --</option>
                            <option value="A" <?= ($data['nilaiHuruf'] == 'A') ? 'selected' : '' ?>>A (90-100)</option>
                            <option value="B" <?= ($data['nilaiHuruf'] == 'B') ? 'selected' : '' ?>>B (80-89)</option>
                            <option value="C" <?= ($data['nilaiHuruf'] == 'C') ? 'selected' : '' ?>>C (70-79)</option>
                            <option value="D" <?= ($data['nilaiHuruf'] == 'D') ? 'selected' : '' ?>>D (60-69)</option>
                            <option value="E" <?= ($data['nilaiHuruf'] == 'E') ? 'selected' : '' ?>>E (0-59)</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="update" class="btn btn-success">Simpan Data</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>