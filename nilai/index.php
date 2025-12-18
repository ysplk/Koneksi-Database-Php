<?php
include('../componen/header.php');
include('../componen/topbar.php');
include('../componen/sidebar.php');
include('../componen/database.php');
?>
<main>
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Data Nilai</h2>
            </div>
            <div class="card-body">
                <div class="text-end">
                    <a href="tambah.php" class="btn btn-success">+ Tambah Nilai</a>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Nilai</th>
                                <th>Grade</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT tbl_nilai.id_nilai, tbl_nilai.nim, tbl_nilai.kodeMatkul, tbl_nilai.nidn, tbl_nilai.nilai, tbl_nilai.nilaiHuruf, tbl_mahasiswa.nama AS nama_mhs, tbl_matkul.namaMatkul, tbl_dosen.nama AS nama_dosen 
                                    FROM tbl_nilai
                                    JOIN tbl_mahasiswa ON tbl_nilai.nim = tbl_mahasiswa.nim
                                    JOIN tbl_matkul ON tbl_nilai.kodeMatkul = tbl_matkul.kodeMatkul
                                    JOIN tbl_dosen ON tbl_nilai.nidn = tbl_dosen.nidn";

                            $query = mysqli_query($koneksi, $sql);
                            $no = 1;

                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['nama_mhs'] . "</td>";
                                echo "<td>" . $row['namaMatkul'] . "</td>";
                                echo "<td>" . $row['nama_dosen'] . "</td>";
                                echo "<td>" . $row['nilai'] . "</td>";
                                echo "<td>" . $row['nilaiHuruf'] . "</td>";
                                echo "<td>";
                                echo "<a href='edit.php?id_nilai=" . $row['id_nilai'] . "' class='btn btn-sm btn-primary me-1'>Edit</a>";
                                echo "<a href='hapus.php?id_nilai=" . $row['id_nilai'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus nilai ini?');\">Hapus</a>";
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