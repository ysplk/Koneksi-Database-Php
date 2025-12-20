<?php
include('../blok.php');
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');
?>
<main>
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Data Mahasiswa</h2>
            </div>
            <div class="card-body">
                <div class="text-end">
                    <a href="tambah.php" class="btn btn-success">+ Tambah Mahasiswa</a>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered ">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th width="100">Foto</th> <!-- Tambahkan kolom Foto -->
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Prodi</th>
                                <th>Angkatan</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tbl_mahasiswa";
                            $query = mysqli_query($koneksi, $sql);

                            while ($mhs = mysqli_fetch_array($query)) {
                                echo "<tr>";

                                // mengecek foto dalam folder uploads
                                $nim_mhs = $mhs['nim'];
                                $foto_path = "/mahasiswa/uploads/gray-user-profile-icon-png-fP8Q1P.png"; // Defaut foto
                                $extensions = ['jpg', 'jpeg', 'png', 'gif'];

                                foreach ($extensions as $ext) {
                                    if (file_exists("uploads/" . $nim_mhs . "." . $ext)) {
                                        $foto_path = "uploads/" . $nim_mhs . "." . $ext . "?t=" . time();
                                        break;
                                    }
                                }
                                // menampilkan foto
                                echo "<td class='text-center'>";
                                echo "<img src='$foto_path' style='width: 60px; height: 60px; object-fit: cover; border: 1px solid #ffffffff;'>";
                                echo "</td>";
                                // memasukkan data mahasiswa 
                                echo "<td>" . $mhs['nim'] . "</td>";
                                echo "<td>" . $mhs['nama'] . "</td>";
                                echo "<td>" . $mhs['prodi'] . "</td>";
                                echo "<td>" . $mhs['angkatan'] . "</td>";
                                echo "<td>" . $mhs['email'] . "</td>";
                                echo "<td>";
                                echo "<a href='edit.php?nim=" . $mhs['nim'] . "' class='btn btn-sm btn-primary me-1'>Edit</a>";
                                echo "<a href='hapus.php?nim=" . $mhs['nim'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus mahasiswa ini?');\">Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('../componen/footer.php');
?>