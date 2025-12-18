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
                <h3 class="mb-0">Data Mata Kuliah</h3>
            </div>
            <div class="card-body">
                <div class="text-end mb-3">
                    <a href="tambah.php" class="btn btn-success">+ Tambah Mata Kuliah</a>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>NIDN Pengajar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tbl_matkul";
                        $query = mysqli_query($koneksi, $sql);

                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['kodeMatkul'] . "</td>";
                            echo "<td>" . $row['namaMatkul'] . "</td>";
                            echo "<td>" . $row['sks'] . "</td>";
                            echo "<td>" . $row['nidn'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit.php?kodeMatkul=" . $row['kodeMatkul'] . "' class='btn btn-sm btn-primary me-1'>Edit</a>";
                            echo "<a href='hapus.php?kodeMatkul=" . $row['kodeMatkul'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus mata kuliah ini?');\">Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include('../componen/footer.php');
?>