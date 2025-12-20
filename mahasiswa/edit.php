<?php
include('../blok.php');
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

$nim = $_GET['nim'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa WHERE nim = '$nim'"));

//default foto 
$foto_tampil = "uploads/gray-user-profile-icon-png-fP8Q1P.png";

$extensions = ['jpg', 'jpeg', 'png', 'gif'];
foreach ($extensions as $ext) {
    // Cek di folder uploads berdarkan nim 
    if (file_exists("uploads/" . $nim . "." . $ext)) {
        $foto_tampil = "uploads/" . $nim . "." . $ext . "?t=" . time();
        break;
    }
}

if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $prodi    = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];
    $email    = $_POST['email'];

    //logika upload foto
    if ($_FILES['foto']['error'] !== 4) {

        $target_dir = "uploads/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES["foto"]["name"]);
        $ekstensi = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ekstensi, $allowed)) {
            // menghapus foto lama
            $files = glob($target_dir . $nim . ".*");
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            // menyimpan foto dan ganti nama menjadi NIM
            $target_file = $target_dir . $nim . "." . $ekstensi;

            if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "<script>alert('Gagal mengupload foto.');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak valid');</script>";
        }
    }
    // query update data mahasiswa
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
                <form action="" method="POST" enctype="multipart/form-data">
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
                            <option value="Teknologi Rekayasa Perangkat Lunak" <?= $data['prodi'] == 'Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' ?>>Teknologi Rekayasa Perangkat Lunak</option>
                            <option value="Teknologi Rekayasa Manufaktur" <?= $data['prodi'] == 'Teknologi Rekayasa Manufaktur' ? 'selected' : '' ?>>Teknologi Rekayasa Manufaktur</option>
                            <option value="Teknologi Rekayasa Mekatronika" <?= $data['prodi'] == 'Teknologi Rekayasa Mekatronika' ? 'selected' : '' ?>>Teknologi Rekayasa Mekatronika</option>
                            <option value="Teknologi Listrik" <?= $data['prodi'] == 'Teknologi Listrik' ? 'selected' : '' ?>>Teknologi Listrik</option>
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

                    <!-- input foto -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto Mahasiswa</label>
                        <div class="d-flex align-items-center gap-3">
                            <img src="<?= $foto_tampil ?>"

                                onerror="this.src='uploads/gray-user-profile-icon-png-fP8Q1P.png';"
                                width="100"
                                class="img-thumbnail"
                                style="border-radius: 0 !important;"
                                alt="Preview Foto">

                            <div class="w-100">
                                <input type="file" name="foto" class="form-control">
                                <small class="text-muted">*Format hanya bisa jpg, jpeg, png , gif</small>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="update" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>