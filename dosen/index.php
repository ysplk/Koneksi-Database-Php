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
                <h3 class="mb-0">Data Dosen</h3>
            </div>
            <div class="card-body">
                <div class="text-end mb-3">
                    <a href="tambah.php" class="btn btn-success">+ Tambah Dosen</a>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Prodi</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tbl_dosen";
                        $query = mysqli_query($koneksi, $sql);

                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['nidn'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['prodi'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit.php?nidn=" . $row['nidn'] . "' class='btn btn-sm btn-primary me-1'>Edit</a>";
                            echo "<a href='hapus.php?nidn=" . $row['nidn'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus dosen ini?');\">Hapus</a>";
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