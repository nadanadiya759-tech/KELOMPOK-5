
<?php
include 'koneksi.php';

$pesan_error = '';
$nama_penerbit = '';
$wilayah_asal = '';
$kontak_sales = '';
$alamat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_penerbit = trim($_POST['nama_penerbit'] ?? '');
    $wilayah_asal = trim($_POST['wilayah_asal'] ?? '');
    $kontak_sales = trim($_POST['kontak_sales'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if (
        $nama_penerbit === '' ||
        $wilayah_asal === '' ||
        $kontak_sales === '' ||
        $alamat === ''
    ) {
        $pesan_error = 'Mohon lengkapi semua kolom wajib.';
    } else {
        $sql = "INSERT INTO penerbit
                (nama_penerbit, wilayah_asal, kontak_sales, alamat)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($koneksi, $sql);

        if ($stmt === false) {
            $pesan_error = 'Query gagal: ' . mysqli_error($koneksi);
        } else {
            mysqli_stmt_bind_param(
                $stmt,
                'ssss',
                $nama_penerbit,
                $wilayah_asal,
                $kontak_sales,
                $alamat
            );

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header('Location: Index.php');
                exit;
            } else {
                $pesan_error = 'Data gagal disimpan: ' .
                    mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerbit - Perpustakaan Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-4 mb-5">
    <h2>Tambah Penerbit</h2>
    <p>Masukkan data penerbit baru ke dalam sistem.</p>

    <?php if ($pesan_error !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($pesan_error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama_penerbit" class="form-label">
                Nama Penerbit
            </label>
            <input type="text" id="nama_penerbit"
                   name="nama_penerbit" class="form-control"
                   value="<?= htmlspecialchars($nama_penerbit, ENT_QUOTES, 'UTF-8') ?>"
                   required>
        </div>

        <div class="mb-3">
            <label for="wilayah_asal" class="form-label">
                Wilayah Asal
            </label>
            <input type="text" id="wilayah_asal"
                   name="wilayah_asal" class="form-control"
                   value="<?= htmlspecialchars($wilayah_asal, ENT_QUOTES, 'UTF-8') ?>"
                   required>
        </div>

        <div class="mb-3">
            <label for="kontak_sales" class="form-label">
                Kontak Sales
            </label>
            <input type="text" id="kontak_sales"
                   name="kontak_sales" class="form-control"
                   value="<?= htmlspecialchars($kontak_sales, ENT_QUOTES, 'UTF-8') ?>"
                   placeholder="Nama & No HP"
                   required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat"
                      class="form-control" rows="3"
                      required><?= htmlspecialchars($alamat, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Penerbit
        </button>

        <a href="Index.php" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>

</body>
</html>