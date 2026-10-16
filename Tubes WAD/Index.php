<?php
require_once "koneksi.php";
if (!isset($conn)) {
    global $conn;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Data Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Perpustakaan Digital</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="index.php">Data Penerbit</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3>Modul Penerbit & Supplier</h3>
                <p class="text-muted mb-0">Daftar data penerbit buku, kontak sales, dan wilayah asal.</p>
            </div>
           
            <a href="tambah.php" class="btn btn-primary">+ Tambah Penerbit</a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Penerbit</th>
                            <th>Wilayah Asal</th>
                            <th>Kontak Sales</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FRO
                        M penerbit");

                        if ($query && mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><b><?= htmlspecialchars($row['nama_penerbit']); ?></b></td>
                                    <td><?= htmlspecialchars($row['wilayah_asal']); ?></td>
                                    <td><?= htmlspecialchars($row['kontak_sales']); ?></td>
                                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="6" class="text-center text-muted py-3">Belum ada data penerbit.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>