<?php
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');

if (isset($_POST['simpan'])) {
    $nidn  = $_POST['nidn'];
    $nama  = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    $sql = "SELECT nidn FROM tbl_dosen WHERE nidn = '$nidn'";
    $cek = mysqli_query($koneksi, $sql);
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIDN sudah terdaftar');</script>";
    } else {
        $insert = "INSERT INTO tbl_dosen (nidn, nama, prodi, email) VALUES ('$nidn', '$nama', '$prodi', '$email')";
        if (mysqli_query($koneksi, $insert)) {
         echo "<script>alert('Data berhasil ditambahkan'); window.location='index.php';</script>";
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
                <h4>Form Tambah Dosen</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>NIDN</label>
                        <input type="text" name="nidn" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Dosen</label>
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
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-warning">Batal</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('../componen/footer.php'); ?>
